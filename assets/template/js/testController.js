$(document).ready(function(){
    $("#pobierzDane").click(function(){

        $.ajax({
            url: 'test/json',
            dataType: 'json',
            beforeSend: function(){
                $("#table1 tbody").html('');
            },
            success: function(data){
                $.each(data, function(i,e){
                    var row = '<tr>' +
                        '<td>' + e.id + '</td>' +
                        '<td>' + e.name + '</td>'+
                        '<td>' + e.age + '</td>'+
                        '</tr>'
                    $("#table1 tbody").append(row);
                });
            },
            error: function(){
                // jesli sie nie powiedzi
            }
        });
    });
    $("#table1").addClass('table-hover');
});