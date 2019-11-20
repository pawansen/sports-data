    <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2><?php echo (isset($headline)) ? ucwords($headline) : ""?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('pwfpanel');?>"><?php echo lang('home');?></a>
            </li>
            <li>
                <a href="<?php echo site_url('users');?>"><?php echo lang('user');?></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">
     <div class="col-md-12">
         <h3 class="text-success">Total Deposite: Rs. <?php echo (!empty($totalAmountReports)) ? $totalAmountReports->total_debit_cash : 0;?></h3>
    </div>
     <div class="col-md-12">
         <h3 class="text-info">Total Winning: Rs. <?php echo (!empty($totalAmountReports)) ? $totalAmountReports->total_winning_cash : 0;?></h3>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                
                <div class="ibox-content">
                 <div class="row">
                      <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#wallet">Cash Wallet History</a></li>
                        <li><a data-toggle="tab" href="#chipWallet">Chip Wallet History</a></li>
                        <li><a data-toggle="tab" href="#deposit">Deposit History</a></li>
                        <li><a data-toggle="tab" href="#cashTransactions">Cash Transaction History</a></li>
                        <li><a data-toggle="tab" href="#cashBonusTransactions">Cash Bonus Transaction History</a></li>
                        <li><a data-toggle="tab" href="#chipTransactions">Chip Transaction History</a></li>
                      </ul>

                       <div class="tab-content">
                            <div id="wallet" class="tab-pane fade in active">
                               <div class="col-lg-12" style="overflow-x: auto">
                                <table class="table table-bordered table-responsive" id="common_datatable_users_wallet">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('serial_no');?></th>
                                            
                                            <th><?php echo "Name";?></th>
                                            <th><?php echo "Deposited Amount";?></th>
                                            <th><?php echo "Winning Amount";?></th>
                                            <th><?php echo "Cash Bonus Amount";?></th>
                                            <th><?php echo "Total Balance";?></th>
                                            <th><?php echo "Update Date";?></th>
                                            <th><?php echo "Create Date";?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        if (isset($cash_wallet_history) && !empty($cash_wallet_history)):
                                            $rowCount = 0;
                                            foreach ($cash_wallet_history as $wallet):
                                                $rowCount++;
                                                ?>
                                        <tr>
                                            <td><?php echo $rowCount; ?></td>        
                                            <td><?php echo $wallet->first_name." (".$wallet->team_code.")"; ?></td>
                                            <td><?php echo getConfig('currency').$wallet->deposited_amount; ?></td>
                                            <td><?php echo getConfig('currency').$wallet->winning_amount; ?></td>
                                            <td><?php echo getConfig('currency').$wallet->cash_bonus_amount; ?></td>
                                            <td><?php echo getConfig('currency').$wallet->total_balance; ?></td>
                                            <td><?php echo date('d-m-y h:i:A',strtotime($wallet->update_date)); ?></td>
                                            <td><?php echo date('d-m-y h:i:A',strtotime($wallet->createdDate)); ?></td>
                                        </tr>
                                        <?php endforeach; endif;?>
                                    </tbody>
                                </table>
                              </div>
                            </div>

                             <div id="chipWallet" class="tab-pane fade">
                               <div class="col-lg-12" style="overflow-x: auto">
                                <table class="table table-bordered table-responsive" id="common_datatable_users_chip_wallet">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('serial_no');?></th>
                                            
                                            <th><?php echo "Name";?></th>
                                            <th><?php echo "Bonus Chip";?></th>
                                            <th><?php echo "Winning Chip";?></th>
                                            <th><?php echo "Chip";?></th>
                                            <th><?php echo "Create Date";?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        if (isset($chip_wallet_history) && !empty($chip_wallet_history)):
                                            $rowCount = 0;
                                            foreach ($chip_wallet_history as $wallet):
                                                $rowCount++;
                                                ?>
                                        <tr>
                                            <td><?php echo $rowCount; ?></td>        
                                            <td><?php echo $wallet->first_name." (".$wallet->team_code.")"; ?></td>
                                            <td><?php echo $wallet->bonus_chip; ?></td>
                                            <td><?php echo $wallet->winning_chip; ?></td>
                                            <td><?php echo $wallet->chip; ?></td>
                                            <td><?php echo date('d-m-y h:i:A',strtotime($wallet->update_date)); ?></td>
                                        
                                        </tr>
                                        <?php endforeach; endif;?>
                                    </tbody>
                                </table>
                              </div>
                            </div>


                            <div id="deposit" class="tab-pane fade">
                              <div class="col-lg-12" style="overflow-x: auto">
                                <table class="table table-bordered table-responsive" id="common_datatable_users_deposit">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('serial_no');?></th>
                                            
                                            <th><?php echo "Order Id";?></th>
                                            <th><?php echo "Name";?></th>
                                            <th><?php echo "Amount";?></th>
                                            <th><?php echo "Transaction Id";?></th>
                                            <th><?php echo "Created Date";?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        if (isset($deposit_history) && !empty($deposit_history)){
                                            $rowCount = 0;
                                            foreach ($deposit_history as $deposit){
                                                $rowCount++;
                                                ?>
                                        <tr>
                                            <td><?php echo $rowCount; ?></td>        
                                            <td><?php echo $deposit->orderId; ?></td>
                                            <td><?php echo $deposit->first_name." (".$deposit->team_code.")"; ?></td>
                                            <td><?php echo getConfig('currency').$deposit->amount; ?></td>
                                            <td><?php echo $deposit->txnid; ?></td>
                                            <td><?php echo date('d-m-y h:i:A',strtotime($deposit->datetime)); ?></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>


                            <div id="cashTransactions" class="tab-pane fade">
                               <div class="col-lg-12" style="overflow-x: auto">
                                <table class="table table-bordered table-responsive" id="common_datatable_users_cash_transaction">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('serial_no');?></th> 
                                            <th><?php echo "Name";?></th>
                                            <th><?php echo "Invited User";?></th>
                                            <th><?php echo "Opening Balance";?></th>
                                            <th><?php echo "Debit";?></th>
                                            <th><?php echo "Credit";?></th>
                                            <th><?php echo "Available Balance";?></th>
                                            <th><?php echo "Transactions Message";?></th>
                                            <th><?php echo "Team vs Team";?></th>
                                            <th><?php echo "Match type";?></th>
                                            <th><?php echo "Created Date";?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        // pr($transactions_history);
                                        if (isset($cash_transactions_history) && !empty($cash_transactions_history)){
                                            $rowCount = 0;
                                            foreach ($cash_transactions_history as $transaction){
                                                $rowCount++;
                                                ?>
                                        <tr>
                                            <td><?php echo $rowCount; ?></td>        
                                            <td><?php echo $transaction->first_name." (".$transaction->team_code.")"; ?></td>

                                            <td><?php 
                                               if($transaction->invite_user_id!=0 && $transaction->invite_user_id!=""){
                                               $options = array(

                                                   'table' => 'users',
                                                   'select' => 'first_name',
                                                   'where'=> array('id'=> $transaction->invite_user_id),
                                                   'single' => true

                                                );
                                               $invited_user = commonGetHelper($options);
                                              
                                            echo $invited_user->first_name;
                                           }else{
                                              echo "";
                                           }

                                             ?></td>

                                            <td><?php echo getConfig('currency').$transaction->opening_balance; ?></td>
                                            <td><?php echo getConfig('currency').$transaction->dr; ?></td>
                                            <td><?php echo getConfig('currency').$transaction->cr; ?></td>
                                            <td><?php echo getConfig('currency').$transaction->available_balance; ?></td>

                                            <td><?php echo $transaction->message; ?></td>
                                            <td><?php echo (!empty($transaction->localteam) && !empty($transaction->visitorteam)) ? "(".$transaction->localteam." vs ".$transaction->visitorteam.")": ""; ?></td>
                                            <td><?php echo $transaction->match_type.' '.$transaction->match_num; ?></td>
                                            <td><?php echo date('d-m-y h:i:A',strtotime($transaction->tranasction_date)); ?></td>
                                            
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                            <div id="cashBonusTransactions" class="tab-pane fade">
                               <div class="col-lg-12" style="overflow-x: auto">
                                <table class="table table-bordered table-responsive" id="common_datatable_users_cash_bonus_transaction">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('serial_no');?></th> 
                                            <th><?php echo "Name";?></th>
                                            <th><?php echo "Invited User";?></th>
                                            <th><?php echo "Opening Balance";?></th>
                                            <th><?php echo "Debit";?></th>
                                            <th><?php echo "Credit";?></th>
                                            <th><?php echo "Available Balance";?></th>
                                            <th><?php echo "Transactions Message";?></th>
                                            <th><?php echo "Team vs Team";?></th>
                                            <th><?php echo "Match type";?></th>
                                            <th><?php echo "Created Date";?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        // pr($transactions_history);
                                        if (isset($cash_bonus_transactions_history) && !empty($cash_bonus_transactions_history)){
                                            $rowCount = 0;
                                            foreach ($cash_bonus_transactions_history as $transaction){
                                                $rowCount++;
                                                ?>
                                        <tr>
                                            <td><?php echo $rowCount; ?></td>        
                                            <td><?php echo $transaction->first_name." (".$transaction->team_code.")"; ?></td>

                                            <td><?php 
                                               if($transaction->invite_user_id!=0 && $transaction->invite_user_id!=""){
                                               $options = array(

                                                   'table' => 'users',
                                                   'select' => 'first_name',
                                                   'where'=> array('id'=> $transaction->invite_user_id),
                                                   'single' => true

                                                );
                                               $invited_user = commonGetHelper($options);
                                              
                                            echo $invited_user->first_name;
                                           }else{
                                              echo "";
                                           }

                                             ?></td>

                                            <td><?php echo getConfig('currency').$transaction->opening_balance; ?></td>
                                            <td><?php echo getConfig('currency').$transaction->dr; ?></td>
                                            <td><?php echo getConfig('currency').$transaction->cr; ?></td>
                                            <td><?php echo getConfig('currency').$transaction->available_balance; ?></td>

                                            <td><?php echo $transaction->message; ?></td>
                                            <td><?php echo (!empty($transaction->localteam) && !empty($transaction->visitorteam)) ? "(".$transaction->localteam." vs ".$transaction->visitorteam.")": ""; ?></td>
                                            <td><?php echo $transaction->match_type.' '.$transaction->match_num; ?></td>
                                            <td><?php echo date('d-m-y h:i:A',strtotime($transaction->tranasction_date)); ?></td>
                                            
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                             <div id="chipTransactions" class="tab-pane fade">
                               <div class="col-lg-12" style="overflow-x: auto">
                                <table class="table table-bordered table-responsive" id="common_datatable_users_chip_transaction">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('serial_no');?></th>
                                            
                                            <th><?php echo "Name";?></th>
                                            <th><?php echo "Opening Balance";?></th>
                                            <th><?php echo "Debit";?></th>
                                            <th><?php echo "Credit";?></th>
                                            <th><?php echo "Available Balance";?></th>
                                            <th><?php echo "Transactions Message";?></th>
                                            <th><?php echo "Team vs Team";?></th>
                                            <th><?php echo "Match type";?></th>
                                            <th><?php echo "Created Date";?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        // pr($transactions_history);
                                        if (isset($chip_transactions_history) && !empty($chip_transactions_history)){
                                            $rowCount = 0;
                                            foreach ($chip_transactions_history as $transaction){
                                                $rowCount++;
                                                ?>
                                        <tr>
                                            <td><?php echo $rowCount; ?></td>        
                                            <td><?php echo $transaction->first_name." (".$transaction->team_code.")"; ?></td>
                                           <td><?php echo $transaction->opening_balance; ?></td>
                                            <td><?php echo $transaction->dr; ?></td>
                                            <td><?php echo $transaction->cr; ?></td>
                                            <td><?php echo $transaction->available_balance; ?></td>
                                            <td><?php echo $transaction->message; ?></td>
                                            <td><?php echo (!empty($transaction->localteam) && !empty($transaction->visitorteam)) ? "(".$transaction->localteam." vs ".$transaction->visitorteam.")": ""; ?></td>
                                            <td><?php echo $transaction->match_type; ?></td>
                                            <td><?php echo date('d-m-y h:i:A',strtotime($transaction->tranasction_date)); ?></td>
                                            
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>



                       </div>
                </div>
            </div>
                <!-- <div id="form-modal-box"></div> -->
        </div>
    </div>
</div>