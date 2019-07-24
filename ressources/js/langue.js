function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
$("#fr").click(function() {
    setCookie("langue", "fr", 5);
    window.location.reload(true);
});
$("#en").click(function() {
    setCookie("langue", "en", 5);
    window.location.reload(true);
});