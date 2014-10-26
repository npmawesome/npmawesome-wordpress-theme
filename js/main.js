function initGithubStars() {
  var stars = $('.GitHub-stars');

  stars.one('unveil', function(e) {
    setTimeout(function() {
      var target = $(e.target);

      githubStars(target.data('githubRepo'), function(stars) {
        target.data('githubStars', stars);
        target.html(numeral(stars).format('0a'));
      });
    });
  });

  stars.unveil();
}

function initSyntaxHighlighter() {
  $('pre > code').each(function() {
    var self = $(this);
    var text = self.text();

    if(text.indexOf('npm install') === 0) {
      self.html(text);
    }

    self.parent()
      .addClass('brush: ' + self.attr('class'))
      .html(self.html())
      ;
  });

  $(function() {
    SyntaxHighlighter.highlight();
  });
}

$(function() {
  initGithubStars();
  initSyntaxHighlighter();
});
