function initGithubStars() {
  var stars = $('.github-stars');

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

$(function() {
  initGithubStars();
});
