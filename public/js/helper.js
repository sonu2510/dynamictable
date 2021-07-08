// window.swal({
//     title: "Checking...",
//     text: "Please wait",
//     imageUrl: "images/ajaxloader.gif",
//     showConfirmButton: false,
//     allowOutsideClick: false
// });

function CheckboxCheck(table_id) {
    alert('asd');
    $(document).ready(function (e) {
        if (e.keyCode === 27) {
            $('#"' + table_id + '" tbody input[type="checkbox"]').prop('checked',
                false);
            $('.select_all').prop('checked', false);
        }
        $('body').on('click', '.select_all', function () {
            if ($(this).is(':checked', true)) {
                $('#' + table_id + ' tbody input[type="checkbox"]').prop('checked', this.checked);
            } else {
                $('#' + table_id + ' tbody input[type="checkbox"]').prop('checked', this.checked);
            }
        });
    });
    // esc
}

function switchAction(url, table_id) {
    $('.alert-status').bootstrapSwitch('state', true);
    $(document).on('switchChange.bootstrapSwitch', '#switch', function (event, state) {

        $('#statuchange').modal('show');
        var status;
        var conformation
        var dataontext = $(this).data('on-text');
        var dataofftext = $(this).data('off-text');
        var id = $(this).data('id');

        if ($(".chkstatus_" + id).is(':checked')) {
            status = 1;
        } else {
            status = 0;
        }
        $(document).one('click', '#mod', function (e) {
            conformation = $(this).val();
            if (conformation == 1) {
                $.ajax({
                    url: url,
                    async: false,
                    data: {
                        id: id,
                        status: status
                    },
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            swal("Updated!", "Records Updated Successfully!", "success", 1500);
                            // toastr.success(data.message);
                        }
                    }
                });
            }
            if (conformation == 0) {
                $('#' + table_id).DataTable().draw();
                $('.select_all').prop('checked', false);
            }
        });
    });
}

function MultiActive(url, table_id) {
    $('#active_all').on('click', function () {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });
        var status = 1;
        if (allVals.length <= 0) {
            $('#Multiactive').modal('show');
        } else {
            var join_selected_values = allVals.join(",");
            $('#statuchange').modal('show');
            $(document).one('click', '#mod', function () {
                conformation = $(this).val();
                if (conformation == 1) {
                    $.ajax({
                        url: url,
                        async: false,
                        data: {
                            join_selected_values: join_selected_values,
                            status: status
                        },
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data) {
                                swal({
                                    title: "Updated!",
                                    text: "Records Updated Successfully!",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                // swal("Updated!", "Records Updated Successfully!", "success",1500);
                                // toastr.success(data.message);
                                $('#' + table_id).DataTable().draw();
                                $('.select_all').prop('checked', false);
                            }
                        }
                    });
                }
                if (conformation == 0) {
                    $('#' + table_id).DataTable().draw();
                    $('.select_all').prop('checked', false);
                }
            });
        }
    });
}

function MultiInActive(url, table_id) {
    //InActive Multiple
    $('#inactive_all').on('click', function () {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });
        var status = 0;
        if (allVals.length <= 0) {
            $('#Multiactive').modal('show');
        } else {
            var join_selected_values = allVals.join(",");
            $('#statuchange').modal('show');
            //$('#statuchange').modal('show');
            $(document).one('click', '#mod', function () {
                conformation = $(this).val();
                if (conformation == 1) {
                    $.ajax({
                        url: url,
                        async: false,
                        data: {
                            join_selected_values: join_selected_values,
                            status: status
                        },
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data) {
                                $('.select_all').prop('checked', false);
                                swal({
                                    title: "Updated!",
                                    text: "Records Updated Successfully!",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                // swal("Updated!", "Records Updated Successfully!", "success",1500,false);
                                // toastr.success(data.message);
                                $('#' + table_id).DataTable().draw();
                            }
                        }
                    });
                }
                if (conformation == 0) {
                    $('#' + table_id).DataTable().draw();
                    $('.select_all').prop('checked', false);
                }
            });
        }
    });
    //End
}

function MultiDelete(url, table_id) {
    $('#delete_all').on('click', function () {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });
        if (allVals.length <= 0) {
            $('#Multiactive').modal('show');
        } else {
            var join_selected_values = allVals.join(",");
          //  alert(join_selected_values);
            // $('#statuchange').modal('show');
            // //$('#statuchange').modal('show');
            // $(document).one('click', '#mod', function() {
            // 	conformation = $(this).val();
            // 	if (conformation == 1) {
            $('.select_all').prop('checked', false);
            swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
            }).then(willDelete => {
                if (willDelete.value == true) {
                    $.ajax({
                        url: url,
                        async: true,
                        cache: false,
                        data: {
                            join_selected_values: join_selected_values
                        },
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data) {
                                swal({
                                    title: "Deleted!",
                                    text: "Records Deleted Successfully!",
                                    type: "error",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                // swal("Deleted!", "Records Deleted Successfully!", "error",1500);
                                // toastr.error(data.message);
                                $('#' + table_id).DataTable().draw();
                            }
                        }
                    });
                }else{
                    $('#' + table_id).DataTable().draw();
                    $('.select_all').prop('checked', false);
                }
            });
        }
    });
}
