<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Dischi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Vue CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </head>
<body>
    <!-- Navbar con immagine -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Spotify_logo_with_text.svg" alt="Logo">
            </a>
        </div>
    </nav>

    <div id="app" class="container mt-5">
        <h1 class="text-center mb-4">Lista Dischi</h1>

        <!-- Spinner di caricamento -->
        <div v-if="dischi.length === 0" class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Caricamento...</span>
            </div>
        </div>

        <!-- Lista dei dischi -->
        <div v-else class="row row-cols-1 row-cols-md-3 g-4">
            <div v-for="disco in dischi" :key="disco.title" class="col">
                <div class="card h-100 disco-card" :class="{'faded': selectedDisco}" @click="selectDisco(disco)">
                    <img :src="disco.poster" class="card-img-top" alt="Poster disco">
                    <div class="card-body">
                        <h5 class="card-title">{{ disco.title }}</h5>
                        <p class="card-text">{{ disco.author }} ({{ disco.year }})</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay e dettagli del disco selezionato -->
        <div v-if="selectedDisco" class="overlay">
            <div class="close-btn" @click="closeDisco">X</div>
            <div class="disco-details">
                <img :src="selectedDisco.poster" alt="Poster disco" class="img-fluid mb-3">
                <h2>{{ selectedDisco.title }}</h2>
                <p>{{ selectedDisco.author }} ({{ selectedDisco.year }})</p>
                <p>{{ selectedDisco.genre }}</p>
            </div>
        </div>
    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    dischi: [],  // Lista dischi
                    selectedDisco: null  // Disco selezionato
                };
            },
            mounted() {
                this.getDischi();  // Al montaggio, recupera i dischi
            },
            methods: {
                getDischi() {
                    axios.get('dischi.php')
                        .then(response => {
                            this.dischi = response.data;
                        })
                        .catch(error => {
                            console.error("Errore durante il caricamento dei dischi:", error);
                        });
                },
                selectDisco(disco) {
                    this.selectedDisco = disco;  // Imposta il disco selezionato
                },
                closeDisco() {
                    this.selectedDisco = null;  // Chiudi i dettagli del disco selezionato
                }
            }
        }).mount('#app');
    </script>
<style>
        body {
            background-color: #0d1b2a;
            color: #ffffff;
        }

        .navbar {
            background-color: #14213d;
        }

        .navbar img {
            height: 40px;
        }

        .disco-card {
            background-color: #1f2a44;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }

        .disco-card:hover {
            transform: scale(1.05);
        }

        .disco-card img {
            border-radius: 10px;
            height: 250px;
            object-fit: cover;
        }

        .disco-card .card-title {
            color: #ffffff;
        }

        .disco-card .card-text {
            color: #adb5bd;
        }

        /* Overlay scuro che copre gli altri dischi */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        /* Disco selezionato in primo piano */
        .disco-details {
            background-color: #1f2a44;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            z-index: 1001;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Bottone per chiudere la modal */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }

        /* Effetto di opacità sugli altri dischi */
        .faded {
            opacity: 0.3;
        }
    </style>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
