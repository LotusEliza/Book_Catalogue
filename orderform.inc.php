
<form name="orderform" method="post" action="send_form_email.inc.php">
    <table width="450px">
        <tr>
            <td valign="top">
                <label for="first_name">First Name *</label>
            </td>
            <td valign="top">
                <input  type="text" name="first_name" maxlength="50" size="30">
            </td>
        </tr>
        <tr>
            <td valign="top">
                <label for="address">Address *</label>
            </td>
            <td valign="top">
                <input  type="text" name="address" maxlength="80" size="30">
            </td>
        </tr>
        <tr>
            <td valign="top">
                <label for="email">Email Address *</label>
            </td>
            <td valign="top">
                <input  type="text" name="email" maxlength="80" size="30">
            </td>
        </tr>
        <tr>
            <td valign="top">
                <label for="quantity">Quantity *</label>
            </td>
            <td valign="top">
                <input type="number" name="quantity" min="1" max="100" maxlength="80" size="30">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center">
                <input type="submit" value="Order">
            </td>
        </tr>
    </table>

</form>
