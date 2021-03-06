<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/brazilian-banking-automation
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Tests\BrazilianBankingAutomation\Cnab400;

use Gpupo\BrazilianBankingAutomation\Cnab400\ReturnFile\Trailer;
use Gpupo\Tests\BrazilianBankingAutomation\AbstractTestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * @coversNothing
 */
class TrailerTest extends AbstractTestCase
{
    public function testFormat()
    {
        $provider = Yaml::parse(file_get_contents($this->getResourcesDirectory().'/providers/trailer.yaml'));

        $attrs = [];
        foreach ($provider as $k => $v) {
            $attrs[$k] = $v['original'];
        }

        $trailer = new Trailer($attrs);

        foreach ($provider as $k => $v) {
            $this->assertSame($v['formatted'], $trailer->formatted($k), 'Test failed on '.$k);
        }

        return $trailer;
    }

    /**
     * @depends testFormat
     */
    public function testTestgenerateString(Trailer $trailer)
    {
        $content = file_get_contents($this->getResourcesDirectory().'/fixtures/RETORNO.RET');
        $lines = explode("\r\n", $content);

        $this->assertSame($trailer->generateString(3), $lines[2]);
    }
}
