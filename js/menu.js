$('#toggle').click(function() {
              $(this).toggleClass('active');
              $('#overlay').toggleClass('open');
          });
          
          $('.overlay-menu li').click(function() {
              $('#overlay').removeClass('open');
              $('#toggle').removeClass('active');
          });