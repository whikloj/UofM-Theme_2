(function($) {
  Drupal.behaviors.islandoraInternetArchiveBookReader = {
    attach: function (context, settings) {
      $('.islandora-internet-archive-bookreader',context).once('islandora-bookreader', function () {
        var bookReader = new IslandoraBookReader(settings.islandoraInternetArchiveBookReader);
        bookReader.init();
        bookReader.switchMode(1);
        //bookReader.jumpToPage(1);
        bookReader.resizePageView();
      });
    }
  };
})(jQuery);