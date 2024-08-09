xdebug_start_trace('/data/www/logs/test_trace', XDEBUG_TRACE_HTML);

xdebug_stop_trace(); 

ini_set('display_errors', 1);
    	//restore_error_handler();


    	export XDEBUG_CONFIG="idekey=phpDebug"
    	export PHP_IDE_CONFIG="serverName=xdebugServer"


    	qcachegrind