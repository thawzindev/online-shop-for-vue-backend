<script>
  $(function () {

    $("{{ $id }}").select2({
      minimumInputLength: 2,
      
      ajax: {
        url: "{{ $url }}",
        dataType: 'json',
        delay: 250, 
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
          return {
            results: $.map(data, function (item) {
              return {
                id: item.id,
                text: item.name
              }
            })
          };
        },
        cache: true
      }
    });

  })
</script>