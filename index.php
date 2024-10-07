<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Dischi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>
<body>
    <div id="app" class="container mt-5">
        <h1 class="text-center mb-4">Lista Dischi</h1>
        
        <!-- Placeholder per i dischi -->
        <div v-if="dischi.length === 0" class="text-center">
            Nessun disco disponibile.
        </div>

        <!-- Qui mostreremo i dischi, ma ancora non li abbiamo -->
        <div v-else class="row row-cols-1 row-cols-md-3 g-4">
            <div v-for="disco in dischi" :key="disco.title" class="col">
                <div class="card h-100">
                    <img :src="disco.poster" class="card-img-top" alt="Poster disco">
                    <div class="card-body">
                        <h5 class="card-title">{{ disco.title }}</h5>
                        <p class="card-text">{{ disco.author }} ({{ disco.year }})</p>
                        <p class="card-text"><small class="text-muted">{{ disco.genre }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    dischi: []  // Inizialmente vuoto
                };
            }
        }).mount('#app');
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
