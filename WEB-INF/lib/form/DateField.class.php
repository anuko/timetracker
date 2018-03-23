<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (https://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors:
// | https://www.anuko.com/time_tracker/credits.htm
// +----------------------------------------------------------------------+

import('form.TextField');
import('DateAndTime');

class DateField extends TextField {
  var $mWeekStartDay = 0;
  var $mDateFormat  = "d/m/Y";
  var $lToday      = "Today";
  var $mDateObj;

  var $lCalendarButtons = array('today'=>'Today', 'close'=>'Close');

  function __construct($name) {
    $this->class = 'DateField';
    $this->name = $name;
    $this->mDateObj = new DateAndTime();
    $this->localize();
  }

  function localize()  {
    global $user;
    global $i18n;
  	
    $this->mDateObj->setFormat($user->date_format);

    $this->mMonthNames = $i18n->monthNames;
    $this->mWeekDayShortNames = $i18n->weekdayShortNames;
    $this->lToday = $i18n->get('label.today');
    $this->lCalendarButtons['today'] = $i18n->get('label.today');
    $this->lCalendarButtons['close'] = $i18n->get('button.close');

    $this->mDateFormat = $user->date_format;
    $this->mWeekStartDay = $user->week_start;
  }

  // set current value taken from session or database
  function setValueSafe($value)  {
    if (isset($value) && (strlen($value) > 0)) {
      $this->mDateObj->parseVal($value, DB_DATEFORMAT);
      $this->value = $this->mDateObj->toString($this->mDateFormat); //?
    }
  }
  // get value for storing in session or database
  function getValueSafe() {
    if (strlen($this->value)>0) {
      $this->mDateObj->parseVal($this->value, $this->mDateFormat);  //?
      return $this->mDateObj->toString(DB_DATEFORMAT);
    } else {
      return null;
    }
  }

  function getHtml() {
    global $user;

    if (!$this->isEnabled()) {
      $html = htmlspecialchars($this->getValue()).
        "<input type=\"hidden\" name=\"$this->name\" value=\"".htmlspecialchars($this->getValue())."\">\n";
    } else {

        if ($this->id=="") $this->id = $this->name;

      $html = "";

      // http://www.nsftools.com/tips/JavaScriptTips.htm#datepicker

      $html .= "<style>
            .dpDiv {}
            .dpTable {font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; color: #505050; background-color: #ece9d8; border: 1px solid #AAAAAA;}
            .dpTR {}
            .dpTitleTR {}
            .dpDayTR {}
            .dpTodayButtonTR {}
            .dpTD {border: 1px solid #ece9d8;}
            .dpDayHighlightTD {background-color: #CCCCCC;border: 1px solid #AAAAAA;}
            .dpTDHover {background-color: #aca998;border: 1px solid #888888;cursor: pointer;color: red;}
            .dpTitleTD {}
            .dpButtonTD {}
            .dpTodayButtonTD {}
            .dpDayTD {background-color: #CCCCCC;border: 1px solid #AAAAAA;color: white;}
            .dpTitleText {font-size: 12px;color: gray;font-weight: bold;}
            .dpDayHighlight {color: 4060ff;font-weight: bold;}
            .dpButton {font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;font-size: 10px;color: gray;background: #d8e8ff;font-weight: bold;padding: 0px;}
            .dpTodayButton {font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;font-size: 10px;color: gray;  background: #d8e8ff;font-weight: bold;}
            </style>\n";
      $html .= "<script>
            var datePickerDivID = \"datepicker\";
            var iFrameDivID = \"datepickeriframe\";

            var dayArrayShort = new Array('".join("','",$this->mWeekDayShortNames)."');
            var dayArrayMed = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
            var dayArrayLong = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            var monthArrayShort = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
            var monthArrayMed = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
            var monthArrayLong = new Array('".join("','",$this->mMonthNames)."');

            var defaultDateSeparator = \"".$this->mDateFormat[1]."\";
            var defaultDateFormat = \"".$this->mDateFormat."\";
            var dateSeparator = defaultDateSeparator;
            var dateFormat = defaultDateFormat;
            var startWeek = ".$this->mWeekStartDay.";

          ";
      $html .= "

            function getStartWeekDayNumber(date) {
              var res = date.getDay() - startWeek;
              if (res < 0) {
                res += 7;
              }
              return res;
            }

            function displayDatePicker(dateFieldName, displayBelowThisObject, dtFormat, dtSep) {
              var targetDateField = document.getElementsByName(dateFieldName).item(0);

              if (!displayBelowThisObject) displayBelowThisObject = targetDateField;
              if (dtSep)
                dateSeparator = dtSep;
              else
                dateSeparator = defaultDateSeparator;

              if (dtFormat)
                dateFormat = dtFormat;
              else
                dateFormat = defaultDateFormat;

              var x = displayBelowThisObject.offsetLeft;
              var y = displayBelowThisObject.offsetTop + displayBelowThisObject.offsetHeight ;

              var parent = displayBelowThisObject;
              while (parent.offsetParent) {
                parent = parent.offsetParent;
                x += parent.offsetLeft;
                y += parent.offsetTop ;
              }

              drawDatePicker(targetDateField, x, y);
            }
            function drawDatePicker(targetDateField, x, y) {
              var dt = getFieldDate(targetDateField.value );

              if (!document.getElementById(datePickerDivID)) {
                var newNode = document.createElement(\"div\");
                newNode.setAttribute(\"id\", datePickerDivID);
                newNode.setAttribute(\"class\", \"dpDiv\");
                newNode.setAttribute(\"style\", \"visibility: hidden;\");
                document.body.appendChild(newNode);
              }

              var pickerDiv = document.getElementById(datePickerDivID);
              pickerDiv.style.position = \"absolute\";
              pickerDiv.style.left = x + \"px\";
              pickerDiv.style.top = (y + 3) + \"px\";
              pickerDiv.style.visibility = (pickerDiv.style.visibility == \"visible\" ? \"hidden\" : \"visible\");
              pickerDiv.style.display = (pickerDiv.style.display == \"block\" ? \"none\" : \"block\");
              pickerDiv.style.zIndex = 10000;

              refreshDatePicker(targetDateField.name, dt.getFullYear(), dt.getMonth(), dt.getDate());
            }
            function refreshDatePicker(dateFieldName, year, month, day) {
              var thisDay = new Date();

              if ((month >= 0) && (year > 0)) {
                thisDay = new Date(year, month, 1);
              } else {
                day = thisDay.getDate();
                thisDay.setDate(1);
              }

              var crlf = \"\\r\\n\";
              var TABLE = \"<table cols=7 class='dpTable'>\" + crlf;
              var xTABLE = \"</table>\" + crlf;
              var TR = \"<tr class='dpTR'>\";
              var TR_title = \"<tr class='dpTitleTR' width='150' align='center'>\";
              var TR_days = \"<tr class='dpDayTR'>\";
              var TR_todaybutton = \"<tr class='dpTodayButtonTR'>\";
              var xTR = \"</tr>\" + crlf;
              var TD = \"<td class='dpTD' onMouseOut='this.className=\\\"dpTD\\\";' onMouseOver=' this.className=\\\"dpTDHover\\\";' \";
              var TD_title = \"<td colspan=5 class='dpTitleTD'>\";
              var TD_buttons = \"<td class='dpButtonTD' width='50'>\";
              var TD_todaybutton = \"<td colspan=7 class='dpTodayButtonTD'>\";
              var TD_days = \"<td class='dpDayTD'>\";
              var TD_selected = \"<td class='dpDayHighlightTD' onMouseOut='this.className=\\\"dpDayHighlightTD\\\";' onMouseOver='this.className=\\\"dpTDHover\\\";' \";
              var xTD = \"</td>\" + crlf;
              var DIV_title = \"<div class='dpTitleText'>\";
              var DIV_selected = \"<div class='dpDayHighlight'>\";
              var xDIV = \"</div>\";

              var html = TABLE;

              html += TR_title + '<td colspan=7>';
              html += '<table width=\"250\">'+ TR_title;
              html += TD_buttons + getButtonCodeYear(dateFieldName, thisDay, -1, \"&lt;&lt;\") + getButtonCode(dateFieldName, thisDay, -1, \"&lt;\") + xTD;
              html += TD_title + DIV_title + monthArrayLong[ thisDay.getMonth()] + \" \" + thisDay.getFullYear() + xDIV + xTD;
              html += TD_buttons + getButtonCode(dateFieldName, thisDay, 1, \"&gt;\") + getButtonCodeYear(dateFieldName, thisDay, 1, \"&gt;&gt;\") + xTD;
              html += xTR + '</table>' + xTD;
              html += xTR;

              html += TR_days;
              for(i = 0; i < dayArrayShort.length; i++)
                html += TD_days + dayArrayShort[(i + startWeek) % 7] + xTD;
              html += xTR;

              html += TR;

              //var startD = (thisDay.getDay()-startWeek<0?6:thisDay.getDay()-startWeek);
              var startD = getStartWeekDayNumber(thisDay);
              for (i = 0; i < startD; i++)
                html += TD + \"&nbsp;\" + xTD;

              do {
                dayNum = thisDay.getDate();
                TD_onclick = \" onclick=\\\"updateDateField('\" + dateFieldName + \"', '\" + getDateString(thisDay) + \"');\\\">\";

                if (dayNum == day)
                  html += TD_selected + TD_onclick + DIV_selected + dayNum + xDIV + xTD;
                else
                  html += TD + TD_onclick + dayNum + xTD;

                var startD = getStartWeekDayNumber(thisDay);

                if (startD == 6)
                  html += xTR + TR;

                thisDay.setDate(thisDay.getDate() + 1);
              } while (thisDay.getDate() > 1)

              var startD = getStartWeekDayNumber(thisDay);
              if (startD > 0) {
                for (i = 6; i >= startD; i--) {
                  html += TD + \"&nbsp;\" + xTD;
                }
              }              
              html += xTR;

              var today = new Date();
              var todayString = \"Today is \" + dayArrayMed[today.getDay()] + \", \" + monthArrayMed[ today.getMonth()] + \" \" + today.getDate();
              html += TR_todaybutton + TD_todaybutton;
              html += \"<button class='dpTodayButton' onClick=\\\"refreshDatePicker('\" + dateFieldName + \"'); updateDateFieldOnly('\" + dateFieldName + \"', '\" + getDateString(new Date()) + \"');\\\">".$this->lCalendarButtons['today']."</button> \";
              html += \"<button class='dpTodayButton' onClick='updateDateField(\\\"\" + dateFieldName + \"\\\");'>".$this->lCalendarButtons['close']."</button>\";
              html += xTD + xTR;

              html += xTABLE;

              document.getElementById(datePickerDivID).innerHTML = html;
              adjustiFrame();
            }


            function getButtonCode(dateFieldName, dateVal, adjust, label) {
              var newMonth = (dateVal.getMonth () + adjust) % 12;
              var newYear = dateVal.getFullYear() + parseInt((dateVal.getMonth() + adjust) / 12);
              if (newMonth < 0) {
                newMonth += 12;
                newYear += -1;
              }

              return \"<button class='dpButton' onClick='refreshDatePicker(\\\"\" + dateFieldName + \"\\\", \" + newYear + \", \" + newMonth + \");'>\" + label + \"</button>\";
            }

            function getButtonCodeYear(dateFieldName, dateVal, adjust, label) {
              var newMonth = dateVal.getMonth();
              var newYear = dateVal.getFullYear() + adjust;

              return \"<button class='dpButton' onClick='refreshDatePicker(\\\"\" + dateFieldName + \"\\\", \" + newYear + \", \" + newMonth + \");'>\" + label + \"</button>\";
            }


            function getDateString(dateVal) {\n";
            $html .= "dateVal.locale = \"".$user->lang."\";\n";
            $html .=  "return dateVal.strftime(dateFormat);
            }

            function getFieldDate(dateString) {
              try {
                var dateVal = strptime(dateString, dateFormat);
              } catch(e) {
                dateVal = new Date();
              }
              if (dateVal == null) {
                dateVal = new Date();
              }
              return dateVal;
            }

            function splitDateString(dateString) {
              var dArray;
              if (dateString.indexOf(\"/\") >= 0)
                dArray = dateString.split(\"/\");
              else if (dateString.indexOf(\".\") >= 0)
                dArray = dateString.split(\".\");
              else if (dateString.indexOf(\"-\") >= 0)
                dArray = dateString.split(\"-\");
              else if (dateString.indexOf(\"\\\\\") >= 0)
                dArray = dateString.split(\"\\\\\");
              else
                dArray = false;

              return dArray;
            }

            function updateDateField(dateFieldName, dateString)  {
              var targetDateField = document.getElementsByName(dateFieldName).item(0);
              if (dateString)
                targetDateField.value = dateString;

              var pickerDiv = document.getElementById(datePickerDivID);
              pickerDiv.style.visibility = \"hidden\";
              pickerDiv.style.display = \"none\";

              adjustiFrame();
              targetDateField.focus();

              if ((dateString) && (typeof(datePickerClosed) == \"function\"))
                datePickerClosed(targetDateField);
            }

            function updateDateFieldOnly(dateFieldName, dateString)  {
              var targetDateField = document.getElementsByName(dateFieldName).item(0);
              if (dateString)
                targetDateField.value = dateString;
            }

            function adjustiFrame(pickerDiv, iFrameDiv) {
              var is_opera = (navigator.userAgent.toLowerCase().indexOf(\"opera\") != -1);
              if (is_opera)
                return;

              try {
                if (!document.getElementById(iFrameDivID)) {
                  var newNode = document.createElement(\"iFrame\");
                  newNode.setAttribute(\"id\", iFrameDivID);
                  newNode.setAttribute(\"src\", \"javascript:false;\");
                  newNode.setAttribute(\"scrolling\", \"no\");
                  newNode.setAttribute (\"frameborder\", \"0\");
                  document.body.appendChild(newNode);
                }

                if (!pickerDiv)
                  pickerDiv = document.getElementById(datePickerDivID);
                if (!iFrameDiv)
                  iFrameDiv = document.getElementById(iFrameDivID);

                try {
                  iFrameDiv.style.position = \"absolute\";
                  iFrameDiv.style.width = pickerDiv.offsetWidth;
                  iFrameDiv.style.height = pickerDiv.offsetHeight ;
                  iFrameDiv.style.top = pickerDiv.style.top;
                  iFrameDiv.style.left = pickerDiv.style.left;
                  iFrameDiv.style.zIndex = pickerDiv.style.zIndex - 1;
                  iFrameDiv.style.visibility = pickerDiv.style.visibility ;
                  iFrameDiv.style.display = pickerDiv.style.display;
                } catch(e) {
                }

              } catch (ee) {
              }
            }\n";
      $html .= "</script>\n";

      $html .= "\n\t<input type=\"text\"";
      $html .= " name=\"$this->name\" id=\"$this->id\"";

      if ($this->size!="")
        $html .= " size=\"$this->size\"";

      if ($this->style!="")
         $html .= " style=\"$this->style\"";

        $html .= " maxlength=\"50\"";

      if ($this->on_change!="")
         $html .= " onchange=\"$this->on_change\"";

      if ($this->on_click!="")
         $html .= " onclick=\"$this->on_click\"";

      $html .= " value=\"".htmlspecialchars($this->getValue())."\"";
      $html .= ">";
      
      if (APP_NAME)
      	$app_root = '/'.APP_NAME;

      $html .= "&nbsp;<img src=\"".$app_root."/images/calendar.gif\" width=\"16\" height=\"16\" onclick=\"displayDatePicker('".$this->name."');\">\n";
    }

    return $html;
  }
}
