    
const data2 = [
  {x: '01/03/2023', GDS: 7, mental: 20, CDR: 3}, 
  {x: '03/03/2023', GDS: 7, mental: 20, CDR: 3}, 
  {x: '05/03/2023', GDS: 5, mental: 15, CDR: 2}, 
  {x: '10/03/2023', GDS: 4, mental: 15, CDR: 2}, 
  {x: '18/03/2023', GDS: 4, mental: 15, CDR: 2}, 
  {x: '22/03/2023', GDS: 4, mental: 15, CDR: 2}, 
  {x: '29/03/2023', GDS: 3, mental: 10, CDR: 1}, 
];

const cfg = {
  type: 'line',
  options: {
    responsive: true,
    maintainAspectRatio: true,
    scales: {
      y: {
        min: 0,
        max: 25,
      }
    },
    interaction: {
      intersect: false,
      mode: 'index',
      position: 'nearest',
    },
    plugins: {
      annotation: {
        annotations: {
          line1: {
            type: 'line',
            mode: 'horizontal',
            yMin: 3,
            yMax: 3,
            borderColor: '#0000FF',
            borderDash: [5, 5],
            label: {
              content: ['CDR máx.'],
              enabled: true,
              position: 'center'
            }
          },
          line2: {
            type: 'line',
            mode: 'horizontal',
            yMin: 7,
            yMax: 7,
            borderColor: '#FF0000',
            borderDash: [5, 5],
            label: {
              content: 'GDS máx.',
              enabled: true,
              position: 'center'
            }
          },
          line3: {
            type: 'line',
            mode: 'horizontal',
            yMin: 25,
            yMax: 25,
            borderColor: '#FF00FF',
            borderDash: [5, 5],
            label: {
              content: 'MEC máx.',
              enabled: true,
              position: 'center'
            },
          },
          
        }
      }
    }
  },
  data: {
    datasets: [{
      label: 'GDS',
      data: data,
      borderColor: '#FF0000',
      backgroundColor: '#FF0000',
      parsing: {
        yAxisKey: 'GDS'
      }
    }, {
      label: 'Mini mental/MEC de lobo',
      data: data,
      borderColor: '#FF00FF',
      backgroundColor: '#FF00FF',
      parsing: {
        yAxisKey: 'mental'
      }
    }, {
      label: 'CDR',
      data: data,
      borderColor: '#0000FF',
      backgroundColor: '#0000FF',
      parsing: {
        yAxisKey: 'CDR'
      }
    }]
  },
};

const ctx = document.getElementById('myChart');
new Chart(ctx,cfg,data);