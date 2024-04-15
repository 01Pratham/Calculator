<table class="tbl_summary" style="width: 100%;">
    <tbody hidden>
        <tr>
            <th style="background: rgba(198,224,180,1)">Service Components</th>
            <th style="background: rgba(198,224,180,1)">Monthly Service Pay</th>
            <th style="background: rgba(198,224,180,1)">Months</th>
            <th style="background: rgba(198,224,180,1)">Total Cost</th>
            <th style="background: rgba(198,224,180,1)">One Time Service Pay</th>
        </tr>
        <?php
        foreach ($Array as $KEY => $VAL) {
            // $total = array_sum($Infrastructure[$KEY]) + array_sum($ManagedServices[$KEY]);
            $total = ((!is_null($Infrastructure[$KEY])) ? array_sum($Infrastructure[$KEY]) : 0) + (!is_null($ManagedServices[$KEY]) ? array_sum($ManagedServices[$KEY]) : 0);
        ?>
            <tr>
                <td>ESDS' eNlight Cloud Hosting Services - <?= $VAL['HEAD'] ?></td>
                <td style="white-space: nowrap;"><?= INR($total) ?></td>
                <td><?= intval($Period[$KEY]) ?></td>
                <td style="white-space: nowrap;"><?= INR($total * intval($Period[$KEY])); ?></td>
                <td style="white-space: nowrap;"><?= INR(($total * 12) * 0.05); ?></td>
            </tr>

        <?php
            $FinalTotal[] = $total * intval($period[$KEY]);
            $FinalOTC[] = ($total * 12) * 0.05;
            $estmtname[] = $VAL['HEAD'];
        }
        ?>
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td style="white-space: nowrap;"><?= INR(array_sum($FinalTotal)); ?></td>
            <td style="white-space: nowrap;"><?= INR(array_sum($FinalOTC)); ?></td>
        </tr>
        <tr>
            <th style="background: rgba(198,224,180,1)" colspan=4>Total Cost for <?= implode(" and ", $estmtname); ?> ( Exclusive of Taxes ).</th>
            <th style="background: rgba(198,224,180,1)" style="white-space: nowrap;"><?= INR(array_sum($FinalTotal) + array_sum($FinalOTC)) ?></th>
        </tr>
    </tbody>
</table>
<table class="tbl_tc tbl_summary except" style="width:100%">
    <tr hidden></tr>
    <tr hidden></tr>
    <tr hidden></tr>
    <tr hidden></tr>
    <tr hidden></tr>
    <tr hidden></tr>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;"> </tr>
    <tr style="background: white; border: hidden;"> </tr>
    <tr style="background: white; border: hidden;"> </tr>

    <tbody id="TClines">
        <tr>
            <th class="noBorder" colspan=80 style="color : rgba(0, 182, 255,1)">Terms and Conditions</th>
        </tr>
        <tr style=" border: hidden;" class="noExl">
            <td style="background:white" hidden class="noBorder"></td>
            <td contentEditable="true" colspan=80 class="myTextArea noBorder noExl" id="terms_cond">
                <?php
                $query = mysqli_query($con, "SELECT * FROM `tbl_terms_conditions`");
                while ($line = mysqli_fetch_assoc($query)) {
                    echo "{$line['terms']}<br>";
                }
                ?>
            </td>
        </tr>
    </tbody>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tbody id="AClines">
        <tr>
            <th class="noBorder" colspan=80 style="color : rgba(0, 182, 255,1)">ESDS's Assumptions and Considerations</th>
        </tr>
        <tr class="noExl">
            <td colspan=80 contentEditable="true" class="myTextArea noBorder assump" id="asump">
                Enter your Assumptions.
            </td>
        </tr>
    </tbody>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tr style="background: white; border: hidden;" hidden> </tr>
    <tbody id="EXlines">
        <tr>
            <th class="noBorder" colspan=80 style="color : rgba(0, 182, 255,1)">ESDS's Exclusions</th>
        </tr>
        <tr class="noExl">
            <td colspan="80" contentEditable="true" id="text_excl" class="myTextArea noBorder assump noExl">
                Enter your Exclusions.
            </td>
        </tr>
    </tbody>
</table>

<script>
    function inputLines(textArea, lineID) {
        let text = $(textArea).html()
        let lines = text.split('<br>');

        lines.forEach(function(line) {
            line = line.replace("\n                ", '');
            $(lineID).append(`<tr hidden class = 'line' style = 'width:100%;'><td class = 'noBorder' style = 'width:100%; white-space: nowrap;'>${line}</td></tr>`);
        });
        $(textArea).on({
            "keypress": function(event) {
                if (event.keyCode == 13) {
                    $(this).append("<br>")
                }
            },
            "blur": function() {
                // console.log('h')
                text = $(textArea).html();
                lines = text.split('<br>');

                $(`${lineID} .line`).remove();
                lines.forEach(function(line) {
                    $(lineID).append("<tr hidden class = 'line' style = 'width:100%;'><td class = 'noBorder' style = 'width:100%; white-space: nowrap;'> " + line + " </td></tr>")
                })
            }
        })
    }

    inputLines("#terms_cond", '#TClines');
    inputLines("#asump", '#AClines');
    inputLines("#text_excl", '#EXlines');
</script>