$(function(){
    $.ajax({
        type:"GET",
        cache:false,
        url: "/config/open_list.json", 
        success:function(data){
            try{
                data = eval("(" + data + ")");
            }catch(e){
                data = {};
            }
            _tr = '';
            var m = '', d = '', _t = '', _lt = '', _lt2 = '', nowTime = '';
            
            m = parseInt((new Date).getMonth()) + 1;
            d = (new Date).getDate();
            for(i in data){
                if(data[i][0] == m + '-' + d || data[i][0] == '0'+m + '-' + '0'+d ||data[i][0] == '0'+m + '-' +d || data[i][0] == m + '-' + '0'+d){
		    _t = dateFormat(data[i][6], true);
                    _lt = _t.split(' ');
                    _lt2 = _lt[1].split(':');
                    if(typeof _lt2[1] != 'undefined'){
                        _lt2 = _lt[1].split(':');
                    }else{
                        _lt2 = _lt[4].split(':');
                    }
                    nowTime = _lt2[0] + ":" + _lt2[1];
                    _tr += '<tr class="highlight">';
                    _tr += '<td><a href="' + data[i][2] + '" target="_blank"  style="color:#EB760A">' + data[i][1] + '</a></td>';
                    _tr += '<td style="color:#EB760A">' + nowTime + '</td>';
                    _tr += '<td><a href="/game/game.php?game=' + data[i][5] + '&server=' + data[i][4] + '" target="_blank" style="color:#EB760A">' + data[i][3] + '</a></td>';
                    _tr += '</tr>';               
                    _tr += '<tr>';
                }else{
                     _tr += '<tr>';
                    _tr += '<td><a href="' + data[i][2] + '" target="_blank">' + data[i][1] + '</a></td>';
                    _tr += '<td>' + data[i][0] + '</td>';
                    _tr += '<td><a href="/game/game.php?game=' + data[i][5] + '&server=' + data[i][4] + '" target="_blank">' + data[i][3] + '</a></td>';
                    _tr += '</tr>';               
                    _tr += '<tr>';
                }
                
            }
            $('#server_list tr:last').after(_tr);
        }
    });		
});


/**
 * js方法转换时间戳格式
 */
function dateFormat(timestamp,chinese){
    var datetime = '';
    if (!timestamp){
        datetime = new Date().toLocaleString();
    }else{
        datetime = new Date(parseInt(timestamp)*1000).toLocaleString();
    }
    if (!chinese){
        return datetime.replace(/年|月/g, '-').replace(/日/g, '');
    }
    return datetime;
}