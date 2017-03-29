<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NoticiaController extends Controller
{
    

    public function noticias(){
			// permite requisições a urls externas
			ini_set('allow_url_fopen', 1);
			ini_set('allow_url_include', 1);
			// caminho do feed do meu blog
			$feed = 'http://www.calculuscontabilidade.com/rss/novidades.xml';
			// leitura do feed
			$rss = simplexml_load_file($feed);

			// limite de itens
			$limit = 6;
			// contador
			$count = 0;

			// imprime os itens do feed
			if($rss)
			{
			foreach ( $rss->channel->item as $item )
			{
			// formata e imprime uma string
			printf('<a href="%s" title="%s" >%s</a><br />', $item->link, $item->title, $item->title);
			// incrementamos a variável $count
			$count++;
			// caso nosso contador seja igual ao limite paramos a iteração
			if($count == $limit) break;
			}
			}
			else
			{
			echo 'Não foi possível acessar o blog.';
			}
 
   	}
    public function CampoFeed($tag,$string) {
     $stepOne = explode("<$tag>", $string);
     $stepTwo = explode("<!--$tag-->", $stepOne[1]);
     return $stepTwo[0];
	}

    
}
