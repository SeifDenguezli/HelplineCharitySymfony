(function($){
     $('#categoryfilter').keyup(function(event){
          var input = $(this);
          var val = input.val();
          var regexp = '\\b(.*)';
          for(var i in val){
               regexp += '('+val[i]+')(.*)';
          }
          regexp+='\\b';
          $('#filter div').show();
          $('#filter').find('span').each(function(){
               var span=$(this);
               var resultats = span.text().match(new RegExp(regexp,'i'));
               if(resultats){
                    var string='';
                    for(var i in resultats){
                         if(i > 0) {
                              if (i % 2 == 0) {
                                   string += '<span class="highlighted">' + resultats[i] + '</span>';
                                   console.log(string);
                              }
                              else {

                                        string += resultats[i];

                                   }
                         }

                    }
                    span.empty().append(string);
               }

               else {
                    span.parent().parent().parent().hide();
               }
          })
     });
})(jQuery);