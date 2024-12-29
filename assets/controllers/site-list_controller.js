import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        
        $(document).ready(function() {   

            $('a.js-site-list').on('click', function(e) {
                var $selectedSite = $(this).attr('id');
                var $url = '/atlas/site/' + $selectedSite.substring(4);

                $.ajax({
                    url:    $url,
                    type:   'GET',
                    async: true,

                    success: function(data) {
                        $('#rightColumn').html(data);
                    },

                    error: function(xhr, textStatus, errorThrown) {  
                        alert('Ajax request failed.');  
                    }  
                })

                return false;
            })

         });  

    }
}
