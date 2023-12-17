<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tata Surya Animasi</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: linear-gradient(to bottom, #536976, #292e49);
            /* Updated gradient background */
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }

        canvas {
            display: block;
        }

        .center-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.95);
            /* Slightly increased transparency */
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .center-card p {
            margin: 15px 0;
            /* Increased margin */
            font-size: 18px;
            /* Increased font size */
            color: #333333;
            /* Dark text color */
        }

        .contact-info a {
            color: #039be5;
            /* Updated link color */
            text-decoration: none;
            font-weight: bold;
        }

        .contact-info a:hover {
            text-decoration: underline;
            /* Underline on hover */
        }
    </style>
</head>

<body>

    <script src="https://threejs.org/build/three.js"></script>
    <script src="https://threejs.org/examples/js/libs/stats.min.js"></script>

    <script>
        // Inisialisasi Three.js
        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        var renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        // Pencahayaan
        var ambientLight = new THREE.AmbientLight(0x404040); // Soft white light
        scene.add(ambientLight);

        var directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        directionalLight.position.set(5, 3, 5).normalize();
        scene.add(directionalLight);

        // Membuat Matahari
        var sunGeometry = new THREE.SphereGeometry(5, 32, 32);
        var sunMaterial = new THREE.MeshStandardMaterial({
            emissive: 0xffd700
        });
        var sun = new THREE.Mesh(sunGeometry, sunMaterial);
        scene.add(sun);

        // Membuat Planet-planet
        var planets = [];

        function createPlanet(radius, distance, textureUrl, rotationSpeed) {
            var geometry = new THREE.SphereGeometry(radius, 32, 32);
            var texture = new THREE.TextureLoader().load(textureUrl);
            var material = new THREE.MeshStandardMaterial({
                map: texture,
                metalness: 0.8,
                roughness: 0.2,
                emissive: 0x555555,
                emissiveIntensity: 0.2
            });
            var planet = new THREE.Mesh(geometry, material);
            planet.distance = distance;
            planet.angle = Math.random() * Math.PI * 2;
            planet.rotationSpeed = rotationSpeed;
            scene.add(planet);
            planets.push(planet);
            return planet;
        }

        createPlanet(0.2, 12, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.02); // Merkurius
        createPlanet(0.4, 16, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.015); // Venus
        createPlanet(0.5, 22, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.01); // Bumi
        createPlanet(0.4, 30, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.008); // Mars
        createPlanet(2, 45, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.005); // Jupiter
        createPlanet(1.5, 65, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.003); // Saturnus
        createPlanet(1, 85, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.002); // Uranus
        createPlanet(1, 105, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.001); // Neptunus

        // Saturnus dengan cincin
        var saturnRingGeometry = new THREE.RingGeometry(2.5, 4, 32);
        var saturnRingMaterial = new THREE.MeshBasicMaterial({
            color: 0xffffff,
            side: THREE.DoubleSide
        });
        var saturnRing = new THREE.Mesh(saturnRingGeometry, saturnRingMaterial);
        saturnRing.rotation.x = Math.PI / 2; // Align the ring with the xy-plane
        var saturn = createPlanet(1.5, 65, 'https://threejsfundamentals.org/threejs/resources/images/wall.jpg', 0.003);
        saturn.add(saturnRing);

        // Mengatur kamera
        camera.position.set(0, 30, 20);
        camera.lookAt(0, 0, 0);

        // Bintang latar belakang
        var starsGeometry = new THREE.BufferGeometry();
        var starsMaterial = new THREE.PointsMaterial({
            color: 0xFFFFFF,
            size: 0.1
        });

        var starsVertices = [];
        for (var i = 0; i < 1000; i++) {
            var x = (Math.random() - 0.5) * 2000;
            var y = (Math.random() - 0.5) * 2000;
            var z = (Math.random() - 0.5) * 2000;
            starsVertices.push(x, y, z);
        }

        starsGeometry.setAttribute('position', new THREE.Float32BufferAttribute(starsVertices, 3));
        var stars = new THREE.Points(starsGeometry, starsMaterial);
        scene.add(stars);

        // Membuat animasi
        function animate() {
            requestAnimationFrame(animate);

            // Menggerakkan planet-planet mengelilingi matahari
            planets.forEach(planet => {
                planet.angle += planet.rotationSpeed;
                planet.position.x = Math.cos(planet.angle) * planet.distance;
                planet.position.z = Math.sin(planet.angle) * planet.distance;
            });

            // Memutar cincin Saturnus
            saturnRing.rotation.y += 0.005;

            // Memutar matahari
            sun.rotation.y += 0.001;

            renderer.render(scene, camera);
        }

        animate();

        // Responsif saat ukuran layar berubah
        window.addEventListener('resize', function() {
            var newWidth = window.innerWidth;
            var newHeight = window.innerHeight;

            camera.aspect = newWidth / newHeight;
            camera.updateProjectionMatrix();

            renderer.setSize(newWidth, newHeight);
        });
    </script>
    <div class="center-card">
        <p>Website Ini Dikunci, Mohon Dibayar Terlebih Dahulu.</p>
        <p class="contact-info">Contact: <a href="https://wa.me/6289636402187">+62 896-3640-2187</a></p>
        <p>Thank you for your understanding.</p>
    </div>
</body>

</html>
