
<script type="text/javascript">
      // $(document).ready(function() {
        // function getHost(url) 
        // {
        //   var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
        //   if ( match != null && match.length > 2 && typeof match[2] === 'string' &&   match[2].length > 0 ) return match[2];
        // }
        function toggleSearch(e){
          if(e === "show"){
            $('#searchContent').removeClass('hidden');
            $('#mainContent').addClass('hidden');
          } 

          if(e === "hide") {
            $('#searchContent').addClass('hidden');
            $('#mainContent').removeClass('hidden');
          }

          if(e === "none"){
            $('#searchContent').addClass('hidden');
            $('#mainContent').addClass('hidden');
          }
        }

        jQuery(document).ready(function($)
        {
          // toggleSearch("none");
          var $queryField = $('#s');
          // if($('#s').val() != undefined){

          //   search($('#s').val());
          // }
          $('#s').keyup(function(){
            // var query =
            var query = $('#s').val(); 
            if (query != ""){
               $('#searchContent').removeClass('hidden');
               $('#mainContent').addClass('hidden');
               
               search(query);
               toggleSearch("show");
            } else {
              toggleSearch('hide')
            }
            console.log($inputfield);
            location.replace('#q=' + encodeURIComponent(query));
            
        }).focus().closest('form').on('submit', function() {
          // on form submit, store the query string in the anchor
          location.replace('#q=' + encodeURIComponent($inputfield.val()));
          return false;
        });

        if (location.hash && location.hash.indexOf('#q=') === 0) {
          toggleSearch('show');
          console.log("this is tru");
          var params = location.hash.substring(3);
          var pageParamOffset = params.indexOf('&page=');
          var q, page;
          if (pageParamOffset > -1) {
            q = decodeURIComponent(params.substring(0, pageParamOffset));
            page = params.substring(pageParamOffset).split('=')[1];
          } else {
            q = decodeURIComponent(params);
            page = 1;
          }
          // fill the form
          // $('#s').val(q); 
          // perform the search
          console.log(q);
          console.log(page);

          search(q, page);
        }

      });
      function search(query, page)
        {
        
          var apiUrl = "/api/resource/search/" + query +"?page=" + page;    
          $.getJSON(apiUrl, function(data) 
            {
              console.log(data.total);
              if (data.total == undefined && data.total < 1) 
              {
                console.log(data.total);
                // no results
                $('#hits').empty();
                // $('#pagination').empty();
                return;  
              }
              var html = '';
              // console.log(data.total);
              // console.log(data.length);
              $.each(data.data, function(key, val)
              {
                html += '<div class="hit row clearfix">';
                // console.log(resource.name.value);
                var resource = val;
               
                
                var url = "{{ url('/resources') }}/" + resource.slug;
                var outurl = "{{ url('/out') }}/" + resource.slug;
                
                if(resource.featured_image != undefined && resource.featured_image != "")
                {
                  var featured_img = "{{ asset('/uploads/sites') }}/" + resource.featured_image;
                } else 
                { 
                  var featured_img = "{{ asset('/uploads/sites') }}/image-not-available.png";
                }
                
                if(resource.logo != undefined)
                {
                  var logo = "{{ asset('/uploads/logos') }}/" + resource.logo;
                } else 
                { 
                  var logo = "{{ asset('/uploads/logos') }}/no-logo.jpg";
                }
            
                // var logo = r.logo_file_name.value;
            
                html += '<div class="col-md-3"><a href="' + url + '">';
                html += '<img src="' + logo + '" class="img-responsive" /></a>';
                html+= '<div class="well" style="padding:5px;"><a href="' + outurl + '"><i class="fa fa-link"></i> Website</a>';

                if(resource.twitter != undefined)
                {
                  html +='<br /><a href="' + resource.twitter + '" class="resource-link"><i class="fa fa-twitter"></i> Twitter</a>';
                }
                if(resource.facebook != undefined)
                {
                  html += '<br /><a href="' + resource.facebook + '" class="resource-link"><i class="fa fa-facebook"></i> Facebook</a>';
                }

                if(resource.clicks != undefined){
                  html += '<br /><strong>Clicks: ' + resource.clicks + '</strong>';
                } else {
                  html += '<br /><strong>Clicks: 0</strong>';
                }
                
                html += "</div></div><div class='col-md-9'><a href='"+url+"'><h1>" + resource.name + "</h1></a>";
                
                html += "<a href='"+url+"'><img src='" + featured_img + "' class='img-responsive'></a>";
                
                
                html += "<p>" + resource.description + "</p><p><a href='"+url+"'><i class='fa fa-arrow-circle-right'></i> Read More ...</p></div>";
                html += '</div>';
              });
              
              $('#hits').html(html);
              $('#pagination').bootstrapPaginator({
                currentPage: data.current_page, // Algolia's pagination starts at 0
                nextPage: (data.current_page +1),
                totalPages: data.last_page,
                bootstrapMajorVersion: 3,
                onPageClicked: function(event, originalEvent, type, page) {
                  // if a page is clicked, go to next page performing an additional query
                  
                  
                  if(query === undefined){query = $('#s').val()}
                    console.log(query);
                  location.replace('#q=' + encodeURIComponent(query) + '&page=' + page);
                  search(query, page); 
                }
              });
              
            });
        }
        // function search(q, params) {
        //   index.search(q, params, searchCallback);
        // }
        // events binding
        // $inputfield.keyup(function() {
        //   if($inputfield.val() != ""){

        //     $('#searchContent').removeClass('hidden');
        //   $('#mainContent').addClass('hidden');

        //   // on each keystroke, perform the query
        //   console.log($inputfield.val());
        //   search($inputfield.val());
        //   } else {
        //     $('#searchContent').addClass('hidden');
        //   $('#mainContent').removeClass('hidden');
        //   }
        //   location.replace('#q=' + encodeURIComponent($inputfield.val()));
        // }).focus().closest('form').on('submit', function() {
        //   // on form submit, store the query string in the anchor
        //   location.replace('#q=' + encodeURIComponent($inputfield.val()));
        //   return false;
        // });
        // // check if there is a query+page in the anchor: http://example.org/#q=my+query&page=42
        // if (location.hash && location.hash.indexOf('#q=') === 0) {
        //   var params = location.hash.substring(3);
        //   var pageParamOffset = params.indexOf('&page=');
        //   var q, page;
        //   if (pageParamOffset > -1) {
        //     q = decodeURIComponent(params.substring(0, pageParamOffset));
        //     page = params.substring(pageParamOffset).split('=')[1];
        //   } else {
        //     q = decodeURIComponent(params);
        //     page = 1;
        //   }
        //   // fill the form
        //   $inputfield.val(q);
        //   // perform the search
        //   search(q, { page: (page - 1) });
        // }
     // });

     

      
    </script>
    
    