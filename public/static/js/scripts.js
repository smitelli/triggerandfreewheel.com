var addthis_config = { 'data_track_clickback': true };

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-7354261-1'], ['_trackPageview']);
(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

$(document).ready(function() {
  $('a[rel=external], a[rel=license]').attr('target', '_blank');

  $('.sharebox').click(function() { $(this).select(); });

  if (typeof meta != 'undefined') {
    $('.sharebutton').attr('addthis:title', meta.title).attr('addthis:url', meta.comic_url);

    $('input[name=linktype]').click(function() {
      switch ($(this).attr('id')) {
        case 'linktype_html':
          $('#curl').val('<a href="' + meta.comic_url + '">' + meta.title + '</a>');
          $('#iurl').val('<img src="' + meta.image_url + '" alt="' + meta.title + '" />');
          break;

        case 'linktype_bbcode':
          $('#curl').val('[url=' + meta.comic_url + ']' + meta.title + '[/url]');
          $('#iurl').val('[img]' + meta.image_url + '[/img]');
          break;

        case 'linktype_url':
        default:
          $('#curl').val(meta.comic_url);
          $('#iurl').val(meta.image_url);
          break;
      }
    });
  }
});
