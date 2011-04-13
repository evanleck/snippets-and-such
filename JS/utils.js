// None of this requires jQuery. BTW.
// Single global object namespace
var U = {};
// Log function zapped from Paul Irish
U.log = function() {
	U.log.history = U.log.history || []; // store logs to an array for reference
	var args = Array.prototype.slice.call( arguments );
	U.log.history.push( args );
	if ( window.console ) {
		window.console.log( args );
	};
};
// Assert function zapped from John Resig
U.assert = function( outcome, description ) {
	U.log( outcome ? 'PASS' : 'FAIL' , description );
};
// Cookie handler object with API
U.Cookies = function( window, undefined ) {
	// =========================
	// = Function createCookie =
	// =========================
	/*
		Takes 3 parameters:
			String name
			String value
			Integer days
		
		Returns boolean
	*/
	function createCookie( name, value, days ) {
		var expires;
		
		if ( days ) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			expires = "; expires="+date.toGMTString();
		} else {
			expires = "";
		};
		
		var newc = name + "=" + value + expires + "; path=/";
		
		try {
			document.cookie = newc;
			U.log("Wrote cookie", newc);
			return true;
		} catch ( cookieWriteError ) {
			U.log("Error writing cookie", newc, cookieWriteError);
			return false;
		};
	};
	
	// =======================
	// = Function readCookie =
	// =======================
	/*
		Takes 1 parameter:
			String name
		
		Returns the value of cookie 'name' or null if not found
	*/
	function readCookie( name ) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for ( var i = 0; i < ca.length; i++ ) {
			var c = ca[i];
			while ( c.charAt(0) === ' ' ) {
				c = c.substring(1, c.length);
				if ( c.indexOf( nameEQ ) === 0 ) {
					return c.substring( nameEQ.length, c.length );
				};
			};
		};
		return null;
	};
	
	// ==========================
	// = Function destroyCookie =
	// ==========================
	/*
		Takes 1 parameter:
			String name
		
		Returns boolean
	*/
	function destroyCookie( name ) {
		try {
			createCookie( name, "", -1);
			return true;
		} catch (cookieDestroyError) {
			U.log("Error erasing cookie.", cookieDestroyError);
			return false;
		};
	};
	// API
	return {
		// returns: Boolean
		set: function( name, value, days ) {
			if ( name !== undefined && value !== undefined ) {
				U.log("Creating cookie:", name, value, days);
				return createCookie( name, value, days );
			} else {
				U.log("Sorry, you are missing the required key or value parameters.");
				return false;
			};
		},
		// returns: String
		get: function( name ) {
			return readCookie( name );
		},
		// returns: Boolean
		destroy: function( name ) {
			return destroyCookie( name );
		}
	};
	
}( window );

// localStorage object with API
U.LocalStorage = function( window, undefined ) {
	// check for localStorage in browser window
	// null out our object if not present
	var ls;

	if ( window.localStorage === undefined ) {
		U.log("localStorage is undefined");
		U.LocalStorage = undefined;
	} else {
		ls = window.localStorage;
	};
	
	function readFromStorage( key ) {
		U.log("Trying to fetch", key);
		readFromLS = ls.getItem( key );
		U.log("Fetched", readFromLS, typeof readFromLS);
		return readFromLS;
	};
	
	function writeToStorage( key, value ) {
		try {
			U.log("Writing new key val to LS", key, value);
			ls.setItem( key, value );
			return true;
		} catch ( writeToStorageError ) {
			U.log("Error writing to localStorage", writeToStorageError);
			return false;
		};
	};
	
	function destroyFromStorage( key ) {
		try {
			ls.removeItem( key );
			return true;
		} catch (destroyFromStorageError) {
			U.log("Error destroying from localStorage", destroyFromStorageError);
			return false;
		};
	};
	
	// API to LS object
	return {
		// reader
		// returns: String
		get: function( key ) {
			return readFromStorage( key );
		},
		// writer
		// returns: Boolean
		set: function( key, value ) {
			return writeToStorage( key, value );
		},
		// destroyer
		// returns: Boolean
		destroy: function( key ) {
			return destroyFromStorage( key );
		}
	}; // eof return
}( window );

// storage that uses localStorage if it exists
// falls back to cookies if localStorage doesn't work
U.Store = function( window, undefined ) {
	var uls = window.localStorage !== undefined;
	
	function storeKeyVal( key, val ) {
		if (uls) {
			return U.LocalStorage.set(key, val);
		} else {
			return U.Cookies.set(key, val, 365);
		};
	};
	
	function readKey( key ) {
		if (uls) {
			return U.LocalStorage.get( key );
		} else {
			return U.Cookies.get( key );
		};
	};
	
	function destroyKey( key ) {
		if (uls) {
			return U.LocalStorage.destroy(key);
		} else {
			return U.Cookies.destroy(key);
		};
	};
	
	// API
	return {
		// returns: Boolean
		set: function( key, value ) {
			return storeKeyVal( key, value );
		},
		// returns: String
		get: function( key ) {
			return readKey( key );
		},
		// returns: Boolean
		destroy: function( key ) {
			return destroyKey( key );
		}
	};
	
}( window );
