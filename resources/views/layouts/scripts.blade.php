
<script type="text/javascript">
      // $(document).ready(function() {
        function getHost(url) 
        {
          var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
          if ( match != null && match.length > 2 && typeof match[2] === 'string' &&   match[2].length > 0 ) return match[2];
        }
        
        jQuery(document).ready(function($){
        var $inputfield = $('#q');
        // Replace the following values by your ApplicationID and ApiKey.
        var client = algoliasearch("{{ env('ALGOLIA_APP_ID') }}", "{{ env('ALGOLIA_SEARCH_ONLY_KEY') }}");
        // Replace the following value by the name of the index you want to query.
        var index = client.initIndex('resources');
        // callback called on each query
        function searchCallback(err, content) {
          if (err) {
            // error
            return;
          }
          $('#searchContent').removeClass('hidden');
          $('#mainContent').addClass('hidden');
          if (content.query != $('#q').val()) {
            // do not take out-dated answers into account
            return;
          }
          if (content.hits.length == 0) {
            // no results
            $('#hits').empty();
            $('#pagination').empty();
            return;
            
          }
          console.log(content.hits);
          // Scan all hits and display them
          var html = '';
          for (var i = 0; i < content.hits.length; ++i) {

            var hit = content.hits[i];
            var resource = hit;
            //console.log(hit);
            var hresource = hit._highlightResult;
            html += '<div class="hit row clearfix">';
            // console.log(resource.name.value);
            if(resource.logo != undefined){
              var logo = resource.logo;
              
            } else {
              var logo = "no-logo.jpg";
            }
            // console.log(resource.domain);
            var slug = resource.slug;
            var title = hresource.name.value;
            var url = "{{ url('/resources') }}" + slug;
            var description = hresource.description.value;
            // var domain = getHost(resource.domain.value);
            var outurl = resource.domain;
            var twitter = resource.twitter;
            var facebook = resource.facebook;
            // var logo = r.logo_file_name.value;
            
            html += '<div class="col-md-3"><a href="' + url + '"><img src="/uploads/logos/' + logo + '" class="img-responsive" /></a>';
            html+= '<div class="well" style="padding:5px;"><a href="' + resource.domain + '"><i class="fa fa-link"></i>Website</a>';

            if(twitter != undefined){
              html +='<br /><a href="' + twitter + '" class="resource-link"><i class="fa fa-twitter"></i> Twitter</a>';
            }
            if(facebook != undefined){
              html += '<br /><a href="' + facebook + '" class="resource-link"><i class="fa fa-facebook"></i> Facebook</a>';
            }
            
            html += "</div></div><div class='col-md-8' style='margin-left:20px;'><h1>" + title + "</h1><p>" + description + "</p><p><a href='"+url+"'><i class='fa fa-arrow-circle-right'></i> Read More ...</p><p><a href='"+ outurl +"''><i class='fa fa-link'></i> " + title + "</a></p></div>";
            // for (var attribute in hit._highlightResult) {

            //   html += '<div class="attribute">' +
            //     '<span>' + attribute + ': </span>' +
            //     hit._highlightResult[attribute].value +
            //     '</div>';
            // }
            html += '</div>';
          }
          $('#hits').html(html);
          // initialize the paginator
          $('#pagination').bootstrapPaginator({
            currentPage: (content.page + 1), // Algolia's pagination starts at 0
            totalPages: content.nbPages,
            bootstrapMajorVersion: 3,
            onPageClicked: function(event, originalEvent, type, page) {
              // if a page is clicked, go to next page performing an additional query
              search(content.query, { page: (page - 1) }); // Algolia's pagination starts at 0
              // and update the location to embed the page number
              location.replace('#q=' + encodeURIComponent(content.query) + '&page=' + page);
            }
          });
        }
        // perform a search
        function search(q, params) {
          index.search(q, params, searchCallback);
        }
        // events binding
        $inputfield.keyup(function() {
          if($inputfield.val() != ""){

            $('#searchContent').removeClass('hidden');
          $('#mainContent').addClass('hidden');
          // on each keystroke, perform the query
          console.log($inputfield.val());
          search($inputfield.val());
          } else {
            $('#searchContent').addClass('hidden');
          $('#mainContent').removeClass('hidden');
          }
          
        }).focus().closest('form').on('submit', function() {
          // on form submit, store the query string in the anchor
          location.replace('#q=' + encodeURIComponent($inputfield.val()));
          return false;
        });
        // check if there is a query+page in the anchor: http://example.org/#q=my+query&page=42
        if (location.hash && location.hash.indexOf('#q=') === 0) {
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
          $inputfield.val(q);
          // perform the search
          search(q, { page: (page - 1) });
        }
      });

     

      
    </script>
    
    