    <!-- Required Js -->
    <script src="<?=base_url()?>/template/assets/js/vendor-all.min.js"></script>
    <script src="<?=base_url()?>/template/assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/template/assets/js/ripple.js"></script>
    <script src="<?=base_url()?>/template/assets/js/pcoded.min.js"></script>
    <script src="<?=base_url()?>/template/assets/js/plugins/apexcharts.min.js"></script>

    <script src="<?=base_url()?>/template/assets/js/webcamjs/webcam.min.js"></script>

    <!-- prism Js -->
    <script src="<?=base_url()?>/template/assets/js/plugins/prism.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>

    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        new DataTable('#example2', {
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                }
            }
        });
        
        new DataTable('#example');
       
        $( '#single-select-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>
    
    
</body>

</html>
