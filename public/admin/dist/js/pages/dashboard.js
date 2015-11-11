/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(document).ready(function () {

  "use strict";

    $('#projectStartDate').daterangepicker({
        "singleDatePicker": true,
        "timePickerIncrement": 1,
        "startDate": "10/01/2015",
        "endDate": "10/15/2016",
        "opens": "left",
        "drops": "down",
        "buttonClasses": "btn btn-sm",
        "applyClass": "btn-success",
        "cancelClass": "btn-default"
    }, function(start, end, label) {
      console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });

    $('#projectEndDate').daterangepicker({
        "singleDatePicker": true,
        "timePickerIncrement": 1,
        "startDate": "010/01/2015",
        "endDate": "07/15/2016",
        "opens": "left",
        "drops": "down",
        "buttonClasses": "btn btn-sm",
        "applyClass": "btn-success",
        "cancelClass": "btn-default"
    }, function(start, end, label) {
      console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });

    $("#userTask").select2();

    // $('#assignTeam').on('change', function(e){
    //     console.log(e);
        
    //     var team_id = e.target.value;
    //     $('#userTask').empty();
    //     $.get('/userTask?team_id=' + team_id, function(data){
    //         alert(data);
    //         $.each(data, function(index, userTask){
    //             $('#userTask').append('<option value="'+userTask.id+'">'+userTask.name+'</option>');
    //         })
    //     });
    // });


});


// $(document).ready(function(){
//   $('#createProject').on('submit',function(e){
//     e.preventDefault(e);
//     $.ajaxSetup({
//       headers: {
//           'X-XSRF-Token': $('meta[name="_token"]').attr('content')
//       }
//     });
//     var formData = $(this).serialize();
//     alert(formData);
//     $.ajax({
//       type:"POST",
//       url:'/admin/project',
//       data:formData,
//       dataType: 'json',
//       success: function(data){
//           console.log(data);
//           alert(data);
//       },
//       error: function(data){
//         alert('data');
//       }
//     });
//   });
// });