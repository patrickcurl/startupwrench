<script>
	// $(window).on('hashchange', function() {
 //        if (window.location.hash) {
 //            var page = window.location.hash.replace('#', '');
 //            if (page == Number.NaN || page <= 0) {
 //                return false;
 //            } else {
 //                getResources(page);
 //            }
 //        }
 //    });


	$(document).ready(function() {
        // var $inputfield = $('#search-input');
        
        //  $("#searchSubmit").click(function(e) {
        //     var q = $inputfield.val()
        //     if(q != ""){
        //         search(q);
        //     }
        //     e.preventDefault();
        //     // $inputfield.val(q);
        //  });
		
        // $(document).on('click', '.pagination a', function (e) {
        //     getResources($(this).attr('href').split('page=')[1]);
        //     e.preventDefault();
        // });
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.params = function (params) {
        params._token = "{{ csrf_token() }}";
        //console.log(params);
        return params;
    };
    $('.resource-item').editable({
    	send: 'always',
    	success: function(response, data){
    		console.log(response.msg);
    	}
    });
    // $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //             }
    //         });
	});

	// function getResources(page) {
 //        $.ajax({
 //            url : '?page=' + page,
 //            dataType: 'json',
 //        }).done(function (data) {
 //        	// console.log(data);
 //            $('.resources').html(data);
 //            location.hash = page;
 //        }).fail(function () {
 //            alert('Resources could not be loaded.');
 //        });
 //    }

 //    function search(q) {
 //        // var u = 'admin/resource-links/' + q;
 //        // console.log(u);
 //        $.ajax({
 //            url : '/admin/search-links/' + q,
            
 //            dataType: 'json',
 //        }).done(function (data) {
 //            // console.log(data);
 //            $('.resources').html(data);
 //           // location.hash = page;
 //        }).fail(function () {
 //            alert('Resources could not be loaded.');
 //        });
 //    }
</script>