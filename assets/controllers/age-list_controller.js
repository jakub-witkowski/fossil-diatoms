import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        
        $(document).ready(function() {   

            $('a.js-age-list').on('click', function(e) {
                var $selectedAge = $(this).attr('id');
                var $url = '/relative-age/' + $selectedAge.substring(3);

                $.ajax({
                    url:    $url,
                    type:   'GET',
                    async: true,

                    success: function(data) {
                        $('#lower-panel').html(data);
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
