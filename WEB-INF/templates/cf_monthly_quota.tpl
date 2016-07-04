{$forms.monthlyQuotaForm.open}
<div style="padding: 0 0 10 0">
    <table border="0" class="divider">
        <tr>
            <td align="center">
                <table>
                    <tr>
                        <td>{$i18n.label.dailyWorkingHours}</td>
                        <td>{$forms.monthlyQuotaForm.dailyWorkingHours.control}</td>
                        <td><input type="submit" name="dailyHours" value="{$i18n.button.save}"></td>
                    </tr>
                </table>
            </td>
        </tr>        
    </table>
</div>
<table>
    <tr>
        <td>{$i18n.label.year}:</td>
        <td>{$forms.monthlyQuotaForm.years.control}</td>
    </tr>
    <tr>
        <td colspan="2">
            <table> 
            <tr>
                <td class="tableHeader">{$i18n.label.month}</td>
                <td class="tableHeader">{$i18n.label.quota}</td>
            </tr>
 {foreach $months as $month}
                <tr>
                    <td>{$month}</td>
                    <td>{$forms.monthlyQuotaForm.$month.control}</td>
                </tr>
 {/foreach}     
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="quotas" value="{$i18n.button.save}*">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div>* - {$i18n.label.empty_values_explanation}</div>
{$forms.monthlyQuotaForm.close}
<script>
function yearChange(value){
    var url = window.location.href;
    
    if (url.indexOf('?') > 0){
        var parameter = url.substring(url.indexOf('?') + 1, url.length);
        url = url.replace(parameter, 'year=' + value);
    } else {
        url = '?year=' + value;
    }
    
    window.location = url;
}
</script>