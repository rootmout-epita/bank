<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerRmlxanW\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerRmlxanW/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerRmlxanW.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerRmlxanW\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerRmlxanW\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'RmlxanW',
    'container.build_id' => 'efc4159b',
    'container.build_time' => 1550769397,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerRmlxanW');