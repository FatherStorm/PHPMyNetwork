
<div id="assign" style="display:none">
    <div id="assign_status"></div>
    <table>
        <tr>
            <th></th>
            <th>From</th>
            <th>To</th>
        </tr>
        <tr>
            <th>Device</th>
            <td><Select id="device1" name="device 1"
                        onchange="resetPorts('#port1',$(this).find('option:selected').data('ports'),0);resetPortTypes('#side1',$(this).find('option:selected').data('port_type'));">
                    <?php require('device_dd.php'); ?>
                </select></td>
            <td><Select id="device2" name="device 2"
                        onchange="resetPorts('#port2',$(this).find('option:selected').data('ports'),0);resetPortTypes('#side2',$(this).find('option:selected').data('port_type'));">
                    <?php require('device_dd.php'); ?>
                </select></td>
        </tr>
        <tr>
            <th>Port</th>
            <td><select id="port1" name="ports 1"></td>
            <td><select id="port2" name="ports 2"></td>
        </tr>
        <tr>
            <th>Side</th>
            <td><select id="side1" name="side 1">
                    <option value="Front">Front</option>
                    <option value="Back">Back</option>
                </select>
            </td>
            <td>
                <select id="side2" name="side 2">
                    <option value="Front">Front</option>
                    <option value="Back">Back</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <button class="button savePatch">Save</button>
            </td>
        </tr>
    </table>


    </select>
</div>

<div style="display:none" id="ports_Both">

        <option value="Front">Front</option>
        <option value="Back">Back</option>

</div>


<div style="display:none" id="ports_Front">

        <option value="Front">Front</option>

</div>


<div style="display:none" id="ports_Back">

        <option value="Back">Back</option>

</div>