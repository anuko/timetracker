// http://www.logilab.org/blogentry/6731
// modified to parse formats with unsupported chars and make compatible with IE7

var _DATE_FORMAT_REGXES = {
    'Y': new RegExp('^-?[0-9]+'),
    'd': new RegExp('^[0-9]{1,2}'),
    'm': new RegExp('^[0-9]{1,2}'),
    'H': new RegExp('^[0-9]{1,2}'),
    'M': new RegExp('^[0-9]{1,2}')
}

/*
 * _parseData does the actual parsing job needed by `strptime`
 */
function _parseDate(datestring, format) {
  var skip0 = new RegExp('^0*[0-9]+');
  var skipRE = new RegExp('^.+?(\\s|$)');
  var parsed = {};  
  for (var i1=0,i2=0;i1<format.length;i1++,i2++) {
    var c1 = format.charAt(i1);
    var c2 = datestring.charAt(i2);   
    
    if (c1 == '%') {
        c1 = format.charAt(++i1);
        
        var data;        
        if(c1 in _DATE_FORMAT_REGXES) {
          data = _DATE_FORMAT_REGXES[c1].exec(datestring.substring(i2));          
        } else {
          // skip text that are not parsed
          skip = skipRE.exec(datestring.substring(i2));
          //alert(datestring.substring(i2) + ':' + skip);
          i2 += skip[0].length-2;          
          continue;
        }
        if (!data || !data.length) {          
          return null;
        }
        data = data[0];
        i2 += data.length-1;
        var value = parseInt(data, 10);
        if (isNaN(value)) {
          
          return null;
        }
        parsed[c1] = value;
        continue;
    }
    if (c1 != c2) {      
      return null;
    }
  }  
  return parsed;
}

/*
 * basic implementation of strptime. The only recognized formats
 * defined in _DATE_FORMAT_REGEXES (i.e. %Y, %d, %m, %H, %M)
 */
function strptime(datestring, format) {
    var parsed = _parseDate(datestring, format);    
    if (!parsed) {
    return null;
    }
    
    // create initial date (!!! year=0 means 1900 !!!)
    var date = new Date(0, 0, 1, 0, 0);
    date.setFullYear(0); // reset to year 0
    if (parsed.Y) {
    date.setFullYear(parsed.Y);
    }
    if (parsed.m) {
    if (parsed.m < 1 || parsed.m > 12) {
        return null;
    }
    // !!! month indexes start at 0 in javascript !!!
    date.setMonth(parsed.m - 1);
    }
    if (parsed.d) {
    if (parsed.m < 1 || parsed.m > 31) {
        return null;
    }
    date.setDate(parsed.d);
    }
    if (parsed.H) {
    if (parsed.H < 0 || parsed.H > 23) {
        return null;
    }
    date.setHours(parsed.H);
    }
    if (parsed.M) {
    if (parsed.M < 0 || parsed.M > 59) {
        return null;
    }
    date.setMinutes(parsed.M);
    }
    return date;
}

// and now monkey patch the Timeline's parser ...
/*
 * provide our own custom date parser since the default one only understands
 * iso8601 and gregorian dates
 */
/*
 * Timeline.NativeDateUnit.getParser = function(format) { if (typeof format ==
 * "string") { if (format.indexOf('%') != -1) { return function(datestring) { if
 * (datestring) { return strptime(datestring, format); } return null; }; }
 * format = format.toLowerCase(); } if (format == "iso8601" || format == "iso
 * 8601") { return Timeline.DateTime.parseIso8601DateTime; } return
 * Timeline.DateTime.parseGregorianDateTime; };
 */
