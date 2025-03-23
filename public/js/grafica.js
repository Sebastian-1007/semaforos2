document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('movimientosChart').getContext('2d');
    let movimientosChart;

    function fetchDataAndUpdateChart() {
        fetch('http://3.85.62.21:3000/sistema/semaforo_estudiantes/') // Usa la URL de tu API
            .then(response => response.json())
            .then(data => {
                // Procesar los datos para agrupar por fecha
                const groupedData = data.reduce((acc, item) => {
                    const fecha = item.Fecha.split('T')[0]; // Extraer solo la parte de la fecha (YYYY-MM-DD)
                    if (!acc[fecha]) {
                        acc[fecha] = 0;
                    }
                    acc[fecha] += item.Numero_Cambios; // Sumar los cambios por fecha
                    return acc;
                }, {});

                // Convertir el objeto agrupado en arreglos para la gráfica
                const fechas = Object.keys(groupedData);
                const movimientos = Object.values(groupedData);

                if (movimientosChart) {
                    movimientosChart.destroy();
                }

                movimientosChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Número de Movimientos',
                            data: movimientos,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error)); // Manejo de errores
    }

    // Actualizar la gráfica cada 5 segundos (puedes ajustar este intervalo)
    setInterval(fetchDataAndUpdateChart, 5000);

    // Cargar la gráfica por primera vez
    fetchDataAndUpdateChart();
});