var str = $('#invoice').html();
var l = 3;
if (str.indexOf('.') > 0 && (str.indexOf('.') > str.length - l || l > str.length))
    l = str.length - str.indexOf('.') - 1;
var s1 = str.substring(0, str.length - l);
var s2 = str.substring(str.length - l);
$('#invoice').html(s1 + '<span>' + s2 + '</span>');
