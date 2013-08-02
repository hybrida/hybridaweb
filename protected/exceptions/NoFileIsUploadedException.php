<?php

/**
 * Hvis man forsøker å lage et nytt bilde av en fil som ikke er lastet opp
 * skal denne exceptionen bli kastet. Se app/models/Image.php
 *
 * @author sighol
 */
class NoFileIsUploadedException extends RuntimeException {

}