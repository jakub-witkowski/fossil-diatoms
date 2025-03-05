import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        
        $(document).ready(function() {

            $("#select").on('click', function() {
                var $selectedAge = $("#select-age-dropdown option:selected").val();
                var $url = '/relative-age/' + $selectedAge;

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
