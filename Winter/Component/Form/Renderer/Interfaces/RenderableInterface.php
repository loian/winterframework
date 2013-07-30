<?php

namespace Winter\Component\Form\Renderer\Interfaces;

use Winter\Component\Form\Renderer\Interfaces\RenderInterface;


/**
 * RenderableInterface
 * 
 * @author Lorenzo Iannone
 */
interface RenderableInterface {
    
    /**
     * Set the renderer object
     * @param \Winter\Component\Form\Renderer\Interfaces\RenderInterface $renderer
     */
    public function setRenderer(RenderInterface $renderer);
    
    /**
     * Get the renderer
     * @return \Winter\Component\Form\Renderer\Interfaces\RenderInterface
     */
    public function getRender();
    
    /**
     * Invoke the renderer->render()
     */
    public function render();
}
