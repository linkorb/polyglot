<?php

namespace Polyglot\Command;

use Symfony\Component\Console\Helper\DescriptorHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\YamlFileLoader;

class TestCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->ignoreValidationErrors();

        $this
            ->setName('polyglot:test')
            ->setDescription('Test command')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Message path'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $output->write("Path: $path\n");
        
        $translator = new Translator('en_US', new MessageSelector());
        $translator->addLoader('yaml', new YamlFileLoader());
        $translator->addResource('yaml', $path . '/messages.yml', 'en_US');
        $translator->setFallbackLocales(array('en'));
        
        var_dump($translator->trans('example'));
    }
}
