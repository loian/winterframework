<?php

namespace Winter\Component\Form\Renderer\Interfaces;

use Winter\Component\Form\Renderer\Interfaces\RendererInterface;


/**
 * RenderableInterface
 * 
 * @author Lorenzo Iannone
 */
interface RenderableInterface {
    
    /**
     * Set the renderer object
     * @param \Winter\Component\Form\Renderer\Interfaces\RendererInterface $renderer
     */
    public function setRenderer(RendererInterface $renderer);
    
    /**
     * Get the renderer
     * @return \Winter\Component\Form\Renderer\Interfaces\RendererInterface
     */
    public function getRender();
    
    /**
     * Invoke the renderer->render()
     */
    public function render();
}
