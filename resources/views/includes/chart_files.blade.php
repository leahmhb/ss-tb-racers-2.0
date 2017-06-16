 <link href="{{ asset('css/c3.min.css') }}" rel="stylesheet"/>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
 <script src="{{ asset('js/c3.min.js') }}"></script>

 <script>

  function donutChart(id, data, title){
    charts[id] = c3.generate({
      bindto: id,
      data: {columns: data, type: 'donut'},
      size: {height: 300},
      legend: {show:true, position: 'bottom'},
      donut: {title: title}
    });
  };

  function lineChart(id, data, categories){
    charts[id] = c3.generate({
      bindto: id,
      data: {
        json:data,
        keys: {x:'name', value:categories},
      },
      axis: {x: {type: 'category'}, rotated: false},
      grid: {y: {show:true}},
      legend: {position:'right'},
      size: {height: 300}
    });
  };

</script>
