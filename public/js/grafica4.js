document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('sensorChart').getContext('2d'); // Cambiar el ID del canvas
    let sensorChart; // Cambiar el nombre de la variable de la gráfica

    function fetchDataAndUpdateChart() {
        fetch('http://localhost:3000/sistema/sensor_presencia/') // Nueva URL de la API
            .then(response => response.json())
            .then(data => {
                // Procesar los datos para agrupar por fecha
                const groupedData = data.reduce((acc, item) => {
                    const fecha = item.Fecha.split('T')[0]; // Extraer solo la parte de la fecha (YYYY-MM-DD)
                    if (!acc[fecha]) {
                        acc[fecha] = 0;
                    }
                    acc[fecha] += item.Numero_Estudiantes; // Sumar el número de estudiantes por fecha
                    return acc;
                }, {});

                // Convertir el objeto agrupado en arreglos para la gráfica
                const fechas = Object.keys(groupedData);
                const estudiantes = Object.values(groupedData);

                if (sensorChart) {
                    sensorChart.destroy(); // Cambiar el nombre de la gráfica
                }

                sensorChart = new Chart(ctx, { // Cambiar el nombre de la gráfica
                    type: 'line',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Número de Estudiantes', // Cambiar la etiqueta del dataset
                            data: estudiantes,
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