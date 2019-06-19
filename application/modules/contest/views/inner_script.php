    <link href="<?php echo base_url(); ?>backend_asset/css/validationEngine.jquery.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>backend_asset/js/jquery.validationEngine.js"></script>
<script src="<?php echo base_url(); ?>backend_asset/js/jquery.validationEngine-en.js"></script>
<link href="<?php echo base_url(); ?>backend_asset/css/select2.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>backend_asset/js/select2.js"></script>

<script>
    var matchID = $('#match').val();
    getContestList({match: matchID});
    var base_url = '<?php echo base_url() ?>';

    /*contest list*/
    function getContestList(queryString = false){
        $("#contest").dataTable().fnDestroy();
        var query = '';
        if (queryString)
            query = queryString;
        else
            query = {};
        $('#contest').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": base_url + "contest/get_contest_list",
                "dataType": "json",
                "type": "POST",
                "data": query
            },
            "columns": [
                {"data": "s_no"},
                //{"data":"match"},
                {"data": "contest_name"},
//                {"data": "match_type"},
                {"data": "total_winning_amount"},
                {"data": "contest_size"},
                {"data": "number_of_winners"},
                {"data": "team_entry_fee"},
                {"data": "chip"},
                {"data": "Win/Lose"},
                {"data": "contest_status"},
                {"data": "create_date"},
                {"data": "status"},
                {"data": "action"},
            ],
            "order": [[0, "desc"]],
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 6, 8, 9, 10]
                }]

        });
    }

    function searchContest() {
        var match = $('#match').val();
        var contest_type = $('#contest_type').val();
        var queryString = {match: match, contest_type: contest_type};
        getContestList(queryString);
    }

    var typefilter = $('#type').val();
    if(typefilter != ""){
        var queryString = {contest_type: typefilter};
        getContestList(queryString); 
    }


    $('#addContest').validationEngine();
    $("#matches").select2({
        allowClear: true
    });

    $("#series").select2({
        allowClear: true
    });

    $('#customize_winnings').click(function () {
        $('.field_wrapper').html('');
        $("#no_of_winners").val('');
        $('#set_btn').attr('disabled', true);
        $("#no_of_winners").attr("placeholder", "min 2");
        $("#no_of_winners").attr("readonly", true);
        //if ($(this).prop('checked')==true){
        if (this.checked) {
            $('#set_btn').attr('disabled', false);
            $("#no_of_winners").attr("readonly", false);
        }
    });


    function MyTeams(teamId, seriesId) {
        // alert(seriesId);
        $.ajax({
            url: '<?php echo base_url(); ?>' + "contest/getTeamPlayers",
            type: "post",
            data: {teamId: teamId, seriesId: seriesId},
            success: function (data, textStatus, jqXHR) {
                $('#players_model_box').html(data);
                $("#commonModal1").modal('show');
            }
        });
    }


    function setTeamFees() {
    
        var total_winning_amount = $('#total_winning_amount').val();
        var no_of_winners = $('#no_of_winners').val();
        var contest_sizes = $('#contest_sizes').val();
        var admin_fee_percent = $('#admin_percentage').val();
        var real_money = $('#real_money').val();
        var chip = $('#chip').val();
        if (parseInt(no_of_winners) <= parseInt(contest_sizes)) {
            $('#set_btn').attr('disabled', false);
        } else {
            $('#set_btn').attr('disabled', true);
        }
        var chip_value = 100 - real_money;
        if (contest_sizes != '' && total_winning_amount != '') {
            
            var basic_amount = total_winning_amount / contest_sizes;
            if(admin_fee_percent != ""){
                 var real_team_entry_fee = ((total_winning_amount * admin_fee_percent) / 100);
                 basic_amount = (parseFloat(real_team_entry_fee) + parseFloat(total_winning_amount)) / contest_sizes;
            }
           
            var team_entry_fee = ((basic_amount * real_money) / 100);

            var all_entry_fee = team_entry_fee;
            var chip = ((basic_amount * chip_value) / 100);
            //console.log("team_entry_fee--"+team_entry_fee);
           // console.log("chip--"+chip);
            //var team_entry_fee = ((basic_amount * admin_fee_percent) / 100) + total_basic_amount;

            if (real_money == 0) {
                team_entry_fee = 0;
                chip = real_team_entry_fee;
                chip = chip;
                //chip = Math.round(chip);
            }
            //console.log('chip'+chip);
            if (real_money < 100) {
                if (real_money > 0) {
                    if ((team_entry_fee % 1) != 0) {
                        if ((team_entry_fee % 1) >= 0.5) {
                           // team_entry_fee = parseInt(team_entry_fee) + 1;
                            //team_entry_fee =team_entry_fee + 1;
                            if (chip < 0 && chip < 1) {
                                chip = 0;
                            } else {
                                chip = chip;
                                /*if ((chip % 1) >= 0.5) {
                                    //chip = Math.round(chip) - 1;
                                     chip = chip - 1;
                                } else {
                                   // chip = Math.round(chip);
                                    chip = chip;
                                }*/
                            }
                            //console.log('greater' + team_entry_fee);
                        } else {
                           // team_entry_fee = Math.round(team_entry_fee);
                            team_entry_fee = team_entry_fee;
                             chip = chip;
                            /*if (chip < 1) {
                                //chip = parseInt(chip) + 1;
                                 chip = chip + 1;
                            } else {
                                //chip = Math.round(chip);
                                 chip = chip;
                            }*/
                            //console.log('less' + team_entry_fee);
                        }
                    } else {
                        //console.log('leg2====' + team_entry_fee);
                    }
                }
            }
            
//console.log(team_entry_fee);
//console.log(chip);
            $('#entry_fee').val(team_entry_fee.toFixed(2));
            //$('#chip_value').val(Math.round(chip));
            $('#chip_value').val(chip.toFixed(2));
            $('#chip').val(chip_value);
        } else {
            $("#entry_fee").attr("placeholder", "Rs.0");
            $("#chip_value").attr("placeholder", "0");
            $('#chip').val(chip_value);
        }
    }

    function setTeamFeesOld() {
        var no_of_winners = $('#no_of_winners').val();
        var contest_sizes = $('#contest_sizes').val();
        var total_winning_amount = $('#total_winning_amount').val();
        var admin_fee_percent = $('#admin_percentage').val();
        var real_money = $('#real_money').val();
        var chip_value = 100 - real_money;
        var chip = $('#chip').val();
        if (parseInt(no_of_winners) <= parseInt(contest_sizes)) {
            $('#set_btn').attr('disabled', false);
        } else {
            $('#set_btn').attr('disabled', true);
        }
        if (contest_sizes != '' && total_winning_amount != '') {
            var basic_amount = total_winning_amount / contest_sizes;

            var real_team_entry_fee = ((basic_amount * admin_fee_percent) / 100) + basic_amount;

            var total_basic_amount = ((basic_amount * real_money) / 100);

            var chip = ((basic_amount * chip_value) / 100);

            var team_entry_fee = ((basic_amount * admin_fee_percent) / 100) + total_basic_amount;

            if (real_money == 0) {
                team_entry_fee = 0;
                chip = real_team_entry_fee;
                chip = Math.round(chip);
            }
            //console.log('ream_amount' + team_entry_fee);
            //console.log('real_chip' + chip);
            if (real_money < 100) {
                if (real_money > 0) {
                    if ((team_entry_fee % 1) != 0) {
                        if ((team_entry_fee % 1) >= 0.5) {
                            team_entry_fee = parseInt(team_entry_fee) + 1;
                            if (chip < 0 && chip < 1) {
                                chip = 0;
                            } else {
                                if ((chip % 1) >= 0.5) {
                                    chip = Math.round(chip) - 1;
                                } else {
                                    chip = Math.round(chip);
                                }
                            }
                            //console.log('greater' + team_entry_fee);
                        } else {
                            team_entry_fee = Math.round(team_entry_fee);
                            if (chip < 1) {
                                chip = parseInt(chip) + 1;
                            } else {
                                chip = Math.round(chip);
                            }
                            //console.log('less' + team_entry_fee);
                        }
                    } else {
                        //console.log('leg2====' + team_entry_fee);
                    }
                }
            }

            // $('#entry_fee').val(team_entry_fee);
            $('#entry_fee').val(team_entry_fee.toFixed(2));
            $('#chip_value').val(Math.round(chip));
            $('#chip').val(chip_value);
        } else {
            $("#entry_fee").attr("placeholder", "Rs.0");
            $("#chip_value").attr("placeholder", "0");
            $('#chip').val(chip_value);
        }
    }


    $(document).ready(function () {
        var no_of_winners_ = $('#no_of_winners_').val();
        if (no_of_winners_ != 0 && typeof no_of_winners_ !== 'undefined') {//during edit
            var count = $('#count_').val();
            var total_winning_amt = $('#total_winning_amount_').val();
            var select_count = $('#select_count').val();
            var no_of_winners = $('#no_of_winners_').val();
            var percentage = $('#percentage_').val();
            var contest_sizes = $('#contest_size_').val();
        } else {//during add
            var count = 0;
            var total_winning_amt = 0;
            var select_count = 0;
            var no_of_winners = 0;
            var percentage = 0;
            var contest_sizes = 0;
            var max_value = 0;//for getting the last winner value selected
        }

        var wrapper = $('.field_wrapper');
        $('.set_btn').click(function () {
            total_winning_amt = $('#total_winning_amount').val();
            no_of_winners = $('#no_of_winners').val();
            contest_sizes = $('#contest_sizes').val();
            if (contest_sizes != '' && no_of_winners != '') {
                count = 1;
                select_count = 1;
                var fieldHTML = '<div class="col-md-12" id="div' + count + '"><div class="form-group"><div class="col-md-1"><label class="control-label">From</label></div><div class="col-md-2"><select class="form-control validate[required]" id="select_' + select_count + '" name="select[' + count + '][]"><option value="1">1</option></select></div><div class="col-md-1"><label class="control-label">To</label></div><div class="col-md-2">';
                select_count++;
                fieldHTML += '<select class="form-control validate[required] second_select" id="select_' + select_count + '" data-pid="' + count + '" name="select[' + count + '][]">';
                for (var i = 1; i <= no_of_winners; i++) {
                    fieldHTML += '<option value="' + i + '">' + i + '</option>';
                }
                fieldHTML += '</select></div><div class="col-md-1"><label class="control-label">Percent</label></div><div class="col-md-1"><input type="text" name="select[' + count + '][]" class="form-control input_select validate[required]" id="percent_' + count + '" data-pid="' + count + '"></div><div class="col-md-1"><label class="control-label">Amount</label></div><div class="col-md-2"><input type="text" readonly class="form-control" id="amount' + count + '" name="select[' + count + '][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field" id="' + count + '"><i class="fa fa-minus" aria-hidden="true"></i></a>&nbsp;<a href="javascript:void(0);" class="add_btn" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a></div></div>';

                if (no_of_winners != '' && contest_sizes != '' && (parseInt(no_of_winners) <= parseInt(contest_sizes))) {
                    $('#set_btn').attr('disabled', true);
                    $(wrapper).append(fieldHTML);
                }
            }
        });

        $(wrapper).on('click', '.add_btn', function (e) {
            $('#max_value_exceed').html('');
            $('#addContest').submit();
            var last_field_percent = $('#percent_' + count).val();
            percentage = 0;
            for (var i = 1; i <= count; i++) {
                var last_percent = $('#percent_' + i).val();
                percentage = parseFloat(percentage) + parseFloat(last_percent);
            }
            if (contest_sizes != '' && no_of_winners != '' && percentage < 100) {
                max_value = $('#select_' + select_count).val();
            }
            if ((parseInt(max_value) == (parseInt(no_of_winners) - parseInt(1))) && percentage < 100) {
                count++;
                max_value++;
                select_count++;
                var fieldHTML_ = '<div class="col-md-12" id="div' + count + '"><div class="form-group"><div class="col-md-1"><label class="control-label">From</label></div><div class="col-md-2"><select class="form-control validate[required]" id="select_' + select_count + '" name="select[' + count + '][]"><option value="' + no_of_winners + '">' + no_of_winners + '</option></select></div><div class="col-md-1"><label class="control-label">To</label></div><div class="col-md-2">';
                select_count++;
                fieldHTML_ += '<select name="select[' + count + '][]" class="form-control validate[required] second_select" id="select_' + select_count + '"  data-pid="' + count + '"><option value="' + no_of_winners + '">' + no_of_winners + '</option>';
                fieldHTML_ += '</select></div><div class="col-md-1"><label class="control-label">Percent</label></div><div class="col-md-1"><input type="text" name="select[' + count + '][]" class="form-control validate[required] input_select" data-pid="' + count + '" id="percent_' + count + '"></div><div class="col-md-1"><label class="control-label">Amount</label></div><div class="col-md-2"><input name="select[' + count + '][]" type="text" readonly class="form-control" id="amount' + count + '"></div><a href="javascript:void(0);" class="remove_button" title="Remove field" id="' + count + '"><i class="fa fa-minus" aria-hidden="true"></i></a></div></div>';
                $(wrapper).append(fieldHTML_);
            } else if ((parseInt(max_value) < parseInt(no_of_winners)) && percentage < 100) {
                count++;
                max_value++;
                select_count++;
                var fieldHTML_ = '<div class="col-md-12" id="div' + count + '"><div class="form-group"><div class="col-md-1"><label class="control-label">From</label></div><div class="col-md-2"><select class="form-control validate[required]" name="select[' + count + '][]" id="select_' + select_count + '"><option value="' + max_value + '">' + max_value + '</option></select></div><div class="col-md-1"><label class="control-label">To</label></div><div class="col-md-2">';
                select_count++;
                fieldHTML_ += '<select name="select[' + count + '][]" class="form-control validate[required] second_select" id="select_' + select_count + '" data-pid="' + count + '">';
                for (var i = max_value; i <= no_of_winners; i++) {
                    fieldHTML_ += '<option valuCopyrighte="' + i + '">' + i + '</option>';
                }
                fieldHTML_ += '</select></div><div class="col-md-1"><label class="control-label">Percent</label></div><div class="col-md-1"><input name="select[' + count + '][]" type="text" class="form-control validate[required] input_select" data-pid="' + count + '" id="percent_' + count + '"></div><div class="col-md-1"><label class="control-label">Amount</label></div><div class="col-md-2"><input name="select[' + count + '][]" type="text" readonly class="form-control" id="amount' + count + '"></div><a href="javascript:void(0);" class="remove_button" title="Remove field" id="' + count + '"><i class="fa fa-minus" aria-hidden="true"></i></a></div></div>';
                $(wrapper).append(fieldHTML_);
            } else if (parseInt(max_value) == (parseInt(no_of_winners))) {
                $('#max_value_exceed').html('You can\'t add more winners');
            } else {
                $('#max_value_exceed').html('Percentage sum should be equal to 100 ! You can\'t add more');
            }
        });

        $(wrapper).on('click', '.remove_button', function (e) {
            $('#max_value_exceed').html('');
            var remove_id = $(this).attr("id");
            var overall_count = count;
            for (var i = remove_id; i <= overall_count; i++) {
                $('#div' + i).remove();
                select_count = parseInt(select_count) - parseInt(2);
                count--;
            }
            if (count == 0) {
                select_count = 0;
                $('#set_btn').attr('disabled', false);
            }
            e.preventDefault();
        });


        $(wrapper).on('change keyup', '.second_select,.input_select', function (e) {
            $('#max_value_exceed').html('');
            var overall_count = count;
            var remove_id = $(this).attr('data-pid');
            var percent_val = $('#percent_' + remove_id).val();
            var calculation = ((total_winning_amt * percent_val) / 100);

            var selectCount = overall_count * 2;
            var FromRank = parseInt(selectCount) - Number(1);
            var toRank = selectCount;
            var fromRankVal = $("#select_" + FromRank).val();
            var toRankVal = $("#select_" + toRank).val();
            var totalRankVal = parseInt(toRankVal) - parseInt(fromRankVal);
            if (totalRankVal > 0) {
                if (percent_val != "") {
                    totalRankVal = parseInt(totalRankVal) + Number(1);
                    var eachRankAmount = calculation.toFixed(2) / totalRankVal;
                    $('#amount' + remove_id).val(eachRankAmount.toFixed(2));
                }
            } else {
                $('#amount' + remove_id).val(calculation.toFixed(2));
            }

            $('#addContest').submit();
            remove_id = parseInt(remove_id) + parseInt(1);
            for (var j = remove_id; j <= overall_count; j++) {
                $('#div' + j).remove();
                count--;
                select_count = parseInt(select_count) - parseInt(2);
            }

        });

        $("#submit").click(function (e) {
            var percent = 0;
            var last_percent_field = $('#select_' + (count * 2)).val();
            for (var i = 1; i <= count; i++) {
                var last_percent = $('#percent_' + i).val();
                percent = parseFloat(percent) + parseFloat(last_percent);
            }
            if (last_percent_field < no_of_winners) {
                $('#max_value_exceed').html('All winners should get prize');
                e.preventDefault();
            } else if (percent > 100) {
                $('#max_value_exceed').html('Percentage value exceeded');
                e.preventDefault();
            } else if (percent != '' && percent < 100) {
                $('#max_value_exceed').html('Percent sum should be equal to 100%');
                e.preventDefault();
            } else {
                $('#max_value_exceed').html('');
            }

            //code for matches select
            if ($('#matches').val() == '' || $('#matches').val() == null)
            {
                $('#matches').addClass('validate[required]');
                $('.select2-container-multi').addClass('validate[required]');
            } else {
                $('#matches').removeClass('validate[required]');
                $('.select2-container-multi').removeClass('validate[required]');
            }
        });

        $('#match_type').change(function () {
            var match_type = $(this).val();
            if (match_type == 1) {
                $('.contest').removeClass('hide');
                $('#entry_fee').val();
            } else {
                $('.contest').addClass('hide');
                $('#entry_fee').val(0);
            }

        });

        $('#match_type').change(function () {
            var match_type = $(this).val();
            if (match_type == 1) {
                $(".winning_chip").hide();
                $('#entry_fee').val();

            } else {
                $(".winning_chip").show();
                $('#entry_fee').val(0);

            }

        });
    });


    function resetWinners() {
        $('#max_value_exceed').html('');
        $('.field_wrapper').html('');
        $('#set_btn').attr('disabled', false);
    }

    // function changeContestStatus(contestID, option) {
    //     var option = option.value;
    //     var match = $('#match').val();
    //     var contest_type = $('#contest_type').val();
    //     $.ajax({
    //         url: base_url + "contest/change_contest_status",
    //         type: "post",
    //         dataType: 'json',
    //         data: {contest_id: contestID, option: option},
    //         success: function (result) {
    //             var queryString = {match: match, contest_type: contest_type};
    //             getContestList(queryString);
    //         }
    //     });
    // }


     function changeContestStatus(contestID, option) {
        var message = "";
        var option = option.value;
        var match = $('#match').val();
        var contest_type = $('#contest_type').val();
        if (option == 0) {
            message = "Running";
        } else if (option == 1) {
            message = "Cancelled";
        }else if(option == 2){
             message = "Completed";
        }else{
            message = "Abandon";
        }


        bootbox.confirm({
            message: "Do you want to " + message + " it?",
            buttons: {
                confirm: {
                    label: 'Ok',
                    className: '<?php echo THEME_BUTTON; ?>'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    var url = "<?php echo base_url() ?>contest/change_contest_status";
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {contest_id: contestID, option: option},
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 200) {
                                setTimeout(function () {
                                    $("#message").html("<div class='alert alert-success'>" + response.msg + "</div>");

                                });
                                window.location.reload();

                                //var queryString = {match: match, contest_type: contest_type};
                                //getContestList(queryString);
                                //$('.modal-backdrop').remove();
                               
                            } else {
                                $("#message").html("<div class='alert alert-danger'>" + response.msg + "</div>");
                               // $('.modal-backdrop').remove();
                                window.location.reload();
                            }
                        },
                        error: function (error, ror, r) {
                            bootbox.alert(error);
                        },
                    });
                } else {
                    $('.modal-backdrop').remove();
                    window.location.reload();
                }
            }
        });
    }




    $(".select-2").select2({
        allowClear: true
    });

    $(document).on('change', '#series', function () {
        var _this = $(this).val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url('contest/getMatchDetails') ?>/' + _this,
            dataType: 'html'
        }).done(function (matches) {
            $('#matches').html(matches);
        });

    });

    function changePublishstatus(id, publish_status) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + "contest/update_publish_status",
            type: "post",
            data: {id: id, publish_status: publish_status},
            success: function (data) {
                getContestList();
            }
        });
    }

jQuery('body').on('click', '#all_matches', function () {

     $('#matches option').prop('selected', true);
     $('#matches option[value=""]').prop('selected', false);
      $('#matches').select2();
    
 
});

jQuery('body').on('click', '#clear_all', function () {

      $('#matches option').prop('selected', false);
      $('#matches').select2();
    
 
});

</script>

