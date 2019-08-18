var addthis_config = { 'data_track_clickback': true };

$(document).ready(function() {
  $('a[rel=external], a[rel=license]').attr('target', '_blank');

  $('.sharebox').click(function() { $(this).select(); });

  if (typeof meta != 'undefined') {
    $('.sharebutton').attr('addthis:title', meta.title).attr('addthis:url', meta.comic_url);

    $('input[name=linktype]').click(function() {
      switch ($(this).attr('id')) {
        case 'linktype_html':
          $('#curl').val('<a href="' + meta.comic_url + '">' + meta.title + '</a>');
          $('#iurl').val('<img src="' + meta.image_url + '" alt="' + meta.title + '">');
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
