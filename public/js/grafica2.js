document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('vehiculosChart').getContext('2d');
    let vehiculosChart;

    function fetchDataAndUpdateChart() {
        fetch('http://localhost:3000/sistema/semaforo_vehiculos2/') // Nueva URL de la API
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

                if (vehiculosChart) {
                    vehiculosChart.destroy();
                }

                vehiculosChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Número de Cambios de Vehículos',
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