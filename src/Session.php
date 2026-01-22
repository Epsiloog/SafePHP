<?php

namespace SafePHP;
#===DO NOT USE IT YET ! IT'S NOT FINISHED !!! (That's why there is no doc in the readme about this class)===#
class Session
{
    private bool $RegenerateCookies = true;

    public function __construct($ARegenCookie)
    {
        if ($ARegenCookie === true) {
            $RegenerateCookies = true;
            return session_regenerate_id(true);
        } else {
            $RegenerateCookies = false;
            return session_regenerate_id(false);
        }
    }

    public static function disableSession($ASessionName)
    {
        unset($ASessionName);
    }

    public static function regenSession()
    {

    }

    function regenerate_session_id_unstable_networks()
    {

        // get a new session_id, then set this value on
        // current session + timestamp in case it is
        // accessed soon because of unstable network not
        // getting new cookie value from our upcoming change.
        // this value is checked in regen_session_start()
        // --------------------------------------------------
        $new_session_id = _sess_create_sid();
        $_SESSION['new_session_id'] = $new_session_id;
        $_SESSION['destroyed'] = time();
        //
        // Write and close current session;
        // ---------------------------------
        session_write_close();
        // We have to turn off strict mode here
        // because new session_id won't be on file
        // and we'll will get another session_id
        // from session_start()
        // --------------------------------------
        $was_in_strict_mode = false;
        if (1 == ini_get('session.use_strict_mode')) {
            ini_set('session.use_strict_mode', 0);
            $was_in_strict_mode = true;
        }
        // save our current session vars as they are
        // still set even though we closed the session
        // --------------------------------------------
        $save_session_vars = $_SESSION;
        // Start session with new session ID. By setting session_id
        // to our new session id we get a new empty session because
        // it's not stored yet, the same point as with ini setting.
        // --------------------------------------------------------
        $strict_mode = ini_get('session.use_strict_mode');
        session_id($new_session_id);
        regen_session_start();
        $cur_session_id = session_id();
        //
        // Restore our saved session vars
        // ------------------------------
        $_SESSION = $save_session_vars;
        //
        // and then remove the breadcrumbs left on old session from new session
        // --------------------------------------------------------------------
        unset($_SESSION['destroyed']);
        unset($_SESSION['new_session_id']);
        //
        // close session. reset strict mode and start session again
        // Note: must change ini settings while session is closed
        // --------------------------------------------------------
        session_write_close();
        if ($was_in_strict_mode) {
            @ini_set('session.use_strict_mode', 1);
        }
        // mark_new_session_as_regenerated_for_forensics();
        regen_session_start();
    }


    // -------------------------------
//
// -------------------------------
    function regen_session_start()
    {
        $result = session_start();
        // if started session has been flagged destroyed,
        // either take evasive action or activate the new session
        // ------------------------------------------------------
        if (isset($_SESSION['destroyed'])) {

            // see if this access is after 5 minutes of change to session id
            // if so it's suspect so do something about it.
            // ---------------------------------------------------------------
            if ($_SESSION['destroyed'] + 300 < time()) {
                remove_all_authentication_flag_from_active_sessions($_SESSION['userid']);
                do_some_logging_and_take_some_action();
                throw (new DestroyedSessionAccessException);
            }
            // Hasn't been 5 minutes yet so not fully expired.
            // Could be because lost cookie by unstable network
            // (new session cookie value didn't get set on client).
            // Try again to set proper session ID cookie by closing session,
            // setting new session id, and calling session_start.
            // Sort of defeating purpose of key change so some security
            // risk in doing this for too long or at all, adjust to meet needs.
            // ----------------------------------------------------------------
            if (isset($_SESSION['new_session_id'])) {
                //increment_destroyed_access(session_id());
                session_commit();
                session_id($_SESSION['new_session_id']);
                // New session ID should exist
                session_start();
            }
        }
        return $result;
    }

}