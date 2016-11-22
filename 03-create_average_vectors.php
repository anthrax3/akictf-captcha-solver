<?php

function norm(array $vector0, array $vector1)
{
    $sum = 0;
    foreach ($vector0 as $key => $value) {
        $sum += (int)($value !== $vector1[$key]);
    }
    return $sum;
}

function centeroid(array $vectors)
{
    foreach ($vectors as $vector) {
        foreach ($vector as $index => $value) {
            $sums[$index] = (isset($sums[$index]) ? $sums[$index] : 0) + $value;
        }
    }
    $size = count($vectors[0]);
    foreach ($sums as $index => $value) {
        $sums[$index] /= $size;
    }
    return $sums;
}

function argmin(array $values)
{
    $argmin = $min = null;
    foreach ($values as $key => $value) {
        if ($min === null || $min > $value) {
            $argmin = $key;
            $min = $value;
        }
    }
    return $argmin;
}

function create_average_vectors(array $vectors, $k)
{
    $centeroids = [];
    while (count($centeroids) < $k) {
        if (!$centeroids) {
            $i = array_rand($vectors);
            $centeroids[$i] = $vectors[$i];
        } else {
            $non_centeroids = array_diff_key($vectors, $centeroids);
            $args = $maxs = [];
            foreach ($non_centeroids as $i => $non_centeroid) {
                $norms = [];
                foreach ($centeroids as $j => $centeroid) {
                    $norms[$j] = norm($centeroid, $non_centeroid);
                }
                $max = max($norms);
                $maxs[] = $max;
                $args[$max] = $i;
            }
            $i = $args[max($maxs)];
            $centeroids[$i] = $vectors[$i];
        }
    }


    $try = 0;
    do {
        $clusters = [];
        $previous_centeroids = $centeroids;
        foreach ($vectors as $vector) {
            $norms = [];
            foreach ($centeroids as $j => $centeroid) {
                $norms[$j] = norm($centeroid, $vector);
            }
            $clusters[argmin($norms)][] = $vector;
        }
        $centeroids = [];
        foreach ($clusters as $i => $cluster) {
            $centeroids[$i] = centeroid($cluster);
        }
    } while ($previous_centeroids !== $centeroids && $try++ < 1000);

    $intersects = [];
    foreach ($clusters as $cluster) {
        $intersect = array_fill(0, count($cluster[0]), 0);
        $intersect = array_replace($intersect, array_intersect_key(...array_map('array_filter', $cluster)));
        $intersects[] = $intersect;
    }
    return $intersects;
}

ini_set('memory_limit', '4G');
$source_vectors = json_decode(file_get_contents(__DIR__ . '/vectors/source.json'));
$average_vectors = create_average_vectors($source_vectors, 16);
file_put_contents(__DIR__ . '/vectors/average.json', json_encode($average_vectors));
