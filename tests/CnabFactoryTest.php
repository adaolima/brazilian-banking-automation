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

namespace Gpupo\Tests\BrazilianBankingAutomation;

use Cnab\Retorno\Cnab400\Arquivo;
use Cnab\Retorno\Cnab400\Detalhe;

/**
 * @coversNothing
 */
class CnabFactoryTest extends AbstractTestCase
{
    public function testIsACnbaFile()
    {
        $cnabFactory = new \Cnab\Factory();
        $arquivo = $cnabFactory->createRetorno('Resources/fixtures/RETORNO.RET');
        $this->assertInstanceof(Arquivo::class, $arquivo);

        return $arquivo;
    }

    /**
     * @depends testIsACnbaFile
     */
    public function testCnbaFileHasDetails(Arquivo $arquivo)
    {
        $detalhes = $arquivo->listDetalhes();
        $this->assertInstanceof(Detalhe::class, current($detalhes));
    }
}
