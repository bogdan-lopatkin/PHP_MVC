<?php

namespace Core;

class Renderer
{
  /* @deprecated    public static function render(string $contents, array $data)
    {
        $sysTags = [
            '@foreach' => '<?php foreach',
            '@endforeach' => '} ?>'
        ];

        foreach ($data as $key => $value) {

            if (is_array($value)) {
                $value = "[". implode(',',$value) . "]";
            }
            $contents = preg_replace("/\(\s*\\\${$key}/", '($'.$key, $contents);
            $contents = preg_replace("/{{\s*{$key}\s*}}/", $value, $contents);
        }
        foreach ($sysTags as $sysTag => $replacement) {
            $matches = [];
            preg_match_all("/\@foreach.*?\@endforeach/s", $contents, $matches);
            foreach ($matches[0] ?? [] as $match) {
                $unformattedMatch = $match;
                $re = '/@foreach (\(.*?\))(.*?)\@endforeach/s';
                $ht = json_encode($data['products']);
                $subst = '<?php  $products = json_decode('. $ht . ', true); d($products); foreach $1 { echo "$2"; } ?>';

                $match = preg_replace($re, $subst, $match, 1);
                $match = str_replace(array('{{', '}}'), ['echo', ';'], $match);
                $contents = str_replace($unformattedMatch, $match, $contents);
            }
        }


        eval("?> $contents <?php ");
    }*/

}