<?php


use frontend\models\Quote;
use frontend\models\Client;

$this->title = 'Statements';
//print_r($statements);
$AccountNo = '1232934';
$baseUrl = Yii::$app->request->baseUrl;
$Identity = Yii::$app->user->identity;

?>
<style media="screen">
  th, td {
    padding: 5px;
  }
  table {
    width: 100%;
    margin: 1em 0;
  }
  tbody:before, tbody::after {
    line-height:1em;
    content:".";
    color: hotpink;
    display:block;
  }
  tbody tr:nth-child(even) {
    background: #fefefe;
  }
  tbody tr:nth-child(odd) {
    background: #fafafa;
  }
  tfoot {
    border-top: 1px solid #d5d5d5;
    border-bottom: 1px solid #d5d5d5;

  }
  tfoot td {
    font-weight: bold;
    font-size: 0.8em;
  }
</style>

<div id="cv" class="delayTwo" style="min-width: 95% !important">
  <?php if (count($statements) > 0): ?>
    <div class="mainDetails" >
      <div id="headshot" class="quickFade">
        <img src="<?= $baseUrl;?>/images/logo.png"/>
      </div>

      <div id="name">
        <h1 class="quickFade delayTwo">CIC GROUP</h1>
        <h2 class="quickFade delayThree">Statement of Accounts</h2>
      </div>

      <div id="contactDetails" class="quickFade delayFour contactDetails" style="padding-top: 20px;">
        <ul>
          <li> </li>
          <li>Contact Centre: +254 703099120</li>
          <li>P. O. Box 59485, Nairobi, Kenya</li>
          <li>Website Address: <a href="http://cic.co.ke/"> cic.co.ke </a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </div>

    <div class="mainDetails" id="addressDetails" style="border-bottom-color: #cf8a05;">
      <div id="clientDetails" class="quickFade delayFour contactDetails">
        <ul>
          <li>Accout No: <?=$AccountNo ?></li>
          <li>Issued: <?=date('M d, Y') ?></li>
          <li>Expires: <?=date('M d, Y', strtotime("+7 day")) ?></li>
        </ul>
      </div>

      <div id="contactDetails" class="quickFade delayFour contactDetails">
        <ul>
          <li>Account Name: <?=$Identity['Name'] ?></li>
          <li>Holder Email: <?=$Identity['UserName'] ?> </li>
          <li>Holder Phone: <?=$Identity['PhoneNumber'] ?></li>
        </ul>
      </div>
      <div class="clear"></div>
    </div>

    <div class="mainDetails" style="background: #fff !important; padding: 10px;">
      <?php $premium = $stamp = $commission = $tax = $levy = $fund = $receipt = $net = $balance = 0; ?>
        <table >
          <thead class="">
            <tr>
              <th>Reference</th>
              <th>Risk Date</th>
              <th>Period</th>
              <th>Insured Name</th>
              <th>Net Premium</th>
              <th>Stamp Duty</th>
              <th>Commision Amount</th>
              <th>W/H Tax</th>
              <th>Training Levy</th>
              <th>Policy Fund</th>
              <th>Receipts</th>
              <th>Net</th>
              <th>Balance</th>
            </tr>
          </thead>

          <tbody id="">
            <?php foreach ($statements as $index => $statement): ?>
              <?php $cno = $statement['Customer No_']; $client = Client::find()->where("No_ = '$cno'")->one(); ?>
              <?php $pno = $statement['Document No_']; $policy = Quote::find()->where("No_ = '$pno'")->one(); ?>
              <?php
                $premium += $policy['Premium Amount'];
                $stamp += $policy['Total Stamp Duty'];
                $commission += $policy['Commission Due'];
                $tax += $statement['Use Tax'];
                $levy += $policy['Total Training Levy'];
                $fund += 0; //TODO: fix hard code
                $receipt += $statement['Debit Amount (LCY)'];
                $net += $statement['Credit Amount (LCY)'];
                $balance += $statement['Amount (LCY)'];
              ?>
              <tr class="" >
                <td><?=$statement['Document No_'] ?></td>
                <td><?=substr($statement['Posting Date'], 0, 10) ?></td>
                <td><?=$policy['No_ Of Instalments'] ?></td>
                <td style="font-size: 0.9em; text-transform: uppercase"><?=$client['Name'] ?></td>
                <td><?=number_format($policy['Premium Amount'], 2) ?></td>
                <td><?=number_format($policy['Total Stamp Duty'], 2) ?></td>
                <td><?=number_format($policy['Commission Due'], 2) ?></td>
                <td><?=number_format($statement['Use Tax'], 2) ?></td>
                <td><?=number_format($policy['Total Training Levy'], 2) ?></td>
                <td><?=' ' ?></td>
                <td><?=number_format($statement['Debit Amount (LCY)'], 2) ?></td>
                <td><?=number_format($statement['Credit Amount (LCY)'], 2) ?></td>
                <td><?=number_format($statement['Amount (LCY)'], 2) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>

          <tfoot>
            <tr>
              <td colspan="4">Total</td>
              <td><?=number_format($premium, 2) ?></td>
              <td><?=number_format($stamp, 2) ?></td>
              <td><?=number_format($commission, 2) ?></td>
              <td><?=number_format($tax, 2) ?></td>
              <td><?=number_format($levy, 2) ?></td>
              <td><?=number_format($fund, 2) ?></td>
              <td><?=number_format($receipt, 2) ?></td>
              <td><?=number_format($net, 2) ?></td>
              <td><?=number_format($balance, 2) ?></td>
            </tr>
          </tfoot>
        </table>

        <div class="mainDetails" id="metaDetails">
          <div id="clientDetails" class="quickFade delayFour contactDetails">
            <ul>
              <li>Found <?=count($statements) ?> Record(s)</li>
            </ul>
          </div>
          <div id="contactDetails" class="quickFade delayFour contactDetails">
            <ul>
              <li>Updated a moment ago</li>
            </ul>
          </div>
          <div class="clear"></div>
        </div>
    </div>

  <?php else: ?>
    <div class="engraved">
      <p> Sorry, Could not retrieve your financial statements. <br /> Please contact support for assistance.  </p>
    </div>
  <?php endif; ?>
</div>
