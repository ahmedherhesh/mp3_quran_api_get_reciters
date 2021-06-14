<?php 

class Quran_Player{

    private $count = 0;

    function getReciter($id = 0){

        if(!$id) return;

        if(!$json = file_get_contents('json/_arabic.json')){
            return;
        }

        $current_reciter = false;

        $content = json_decode($json);

        foreach($content->reciters as $reciter){
            if($id == $reciter->id){

                $current_reciter = $reciter;

                break;
            }
        }

        if(!$current_reciter) return;

        $server = $current_reciter->Server;

        $suras = explode(',', $current_reciter->suras);

        $output = array();

        $suras_names = json_decode(file_get_contents("json/_suras.json"),true);

        foreach($suras as $id){
            $length = strlen($id);

            if($length == 1){
                $id = "00" . $id;
            }elseif($length == 2){
                $id = "0" . $id;
            }

            $output[] = array(
                'reciter' => $current_reciter->name,
                'link' => $server . '/' . $id . '.mp3',
                'sura_id' => $id,
                'ar_name' => isset($suras_names[0][$id]['ar_name']) ? $suras_names[0][$id]['ar_name'] : ''
            );
        }
        
        $this->count = count($output);

        $this->getSuras($output);

    }

    function getSuras($reciters){
        if (!$reciters) return;
        ?>
        <div class="container">
        <?php
        echo '<div class="audio-container">';
        echo '<audio src="' . $reciters[0]['link'] . '" controls class="main-player"></audio>';
        echo '</div>';
        echo "<div class='suras-container'>";
        $x = 0;
        foreach ($reciters as $key => $sura) {
            $playing = $x == 0 ? 'playing' : '';
        ?>
            <div class="sura <?php echo "sura-index-{$x}"; ?>">
                <div class="audio">
                    <span class="audio-control surah-num <?php echo $playing; ?>" data-src="<?php echo $sura['link']; ?>"><img src="icons/play.PNG" alt=""></span>
                    <a href="<?php echo $sura['link']; ?>" target="_blank"><img src="icons/download.PNG" class="download" alt="download"></a>
                </div>
                <div class="info">
                    <h4 class="audio-name"> <?php echo $sura['ar_name']; ?> </h4>
                    <span class="surah-num"><?php echo $sura['sura_id']; ?></span>
                </div>
            </div>
        <?php
            $x++;
        }
        ?>
    </div>
    <?php
    }
    function getCount(){
        return $this->count;
    }

}
