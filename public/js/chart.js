const data = [
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
  data: {
    datasets: [{
      label: 'GDS',
      data: data,
      parsing: {
        yAxisKey: 'GDS'
      }
    }, {
      label: 'Mini mental/MEC de lobo',
      data: data,
      parsing: {
        yAxisKey: 'mental'
      }
    }, {
      label: 'CDR',
      data: data,
      parsing: {
        yAxisKey: 'CDR'
      }
    }]
  },
};

const ctx = document.getElementById('myChart');
new Chart(ctx,cfg,data);