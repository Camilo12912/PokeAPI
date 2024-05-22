<?php

class PokemonController
{
    private function fetchFromApi($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    public function getPokemons()
    {
        $data = $this->fetchFromApi('https://pokeapi.co/api/v2/pokemon/');
        $pokemons = $data['results'];
        echo json_encode($pokemons);
    }

    public function getPokemonById($id)
    {
        $data = $this->fetchFromApi("https://pokeapi.co/api/v2/pokemon/{$id}");
        if (!$data) {
            http_response_code(404);
            echo json_encode(['message' => 'Pokemon not found']);
        } else {
            echo json_encode($data);
        }
    }

    public function getTrainerById($id)
    {
        // Aquí puedes implementar la lógica para obtener los datos del entrenador desde tu base de datos
        // Por ahora, solo enviamos datos ficticios
        $trainer = [
            'id' => $id,
            'name' => 'Ash Ketchum',
            'region' => 'Kanto'
        ];
        echo json_encode($trainer);
    }
}
