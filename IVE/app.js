const acordeon = document.getElementsByClassName('contenedor');

for (i=0; i<acordeon.length; i++) {
  acordeon[i].addEventListener('click', function () {
    this.classList.toggle('activa')
  })
}


google.charts.load('current', {
    'packages':['geochart'],
  });
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable([
      ['Country', 'Popularity'],
      ['Chile', 645991],
      ['Mexico', 599051],
      ['United Kingdom', 539526],
      ['Brazil', 523420],
      ['Australia', 460532],
    ]);

    var options = {};

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);
  }



  let slides = document.querySelectorAll('.slide');
  let currentSlide = 0;
  slides[currentSlide].classList.add('active');
  
  function nextSlide() {
      slides[currentSlide].classList.remove('active');
      currentSlide = (currentSlide + 1) % slides.length;
      slides[currentSlide].classList.add('active');
  }
  
  setInterval(nextSlide, 3000); // Cambia de slide cada 3 segundos
  