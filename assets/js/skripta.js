const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const cid = urlParams.get('cid');
const kat = urlParams.get('kat');

if (cid != null) {
	document.getElementById('logo-navigacija').style.borderTop = "0";
	document.getElementById('logo-navigacija').style.borderBottom = "1px solid #EAEAEA";
	document.body.style.backgroundColor = "#EAEAEA";
}

$(window).on("load resize ", function() {
	var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
	$('.tbl-header').css({'padding-right':scrollWidth});
  }).resize();



