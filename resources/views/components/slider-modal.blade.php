{{-- 
    Correct Logic Puzzle Slider Modal Component
    File: resources/views/components/correct-logic-slider-modal.blade.php
--}}

@php
    $modalId = $modalId ?? 'sliderVerificationModal';
    $title = $title ?? 'Letakkan Puzzle pada Posisi yang Tepat';
    $theme = $theme ?? 'default';
    $puzzleImage = $puzzleImage ?? asset('themes/zenblog.png');
@endphp

<!-- Correct Logic Slider Verification Modal -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $title }}</h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <!-- Instructions -->
                <div class="instructions mb-3">
                    <i class="bi bi-info-circle text-primary me-2"></i>
                    <small class="text-muted">Geser slider untuk memindahkan puzzle piece hingga <strong>pas dengan
                            posisi yang kosong</strong></small>
                </div>

                <!-- Error Alert -->
                <div class="alert alert-warning d-none" id="errorAlert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <span id="errorMessage">Posisi belum pas dengan target!</span>
                </div>

                <!-- Puzzle Container -->
                <div class="correct-puzzle-container">

                    <!-- Main Puzzle Area -->
                    <div class="puzzle-main-area">

                        <!-- Complete Background Image -->
                        <div class="complete-background">
                            <img src="{{ $puzzleImage }}" alt="Complete Image" class="complete-img" id="completeImg">
                        </div>

                        <!-- Hole Overlay (covers specific area) -->
                        <div class="hole-overlay" id="holeOverlay">
                            <div class="hole-content">
                                <div class="hole-border"></div>
                                <div class="hole-indicator">
                                    <i class="bi bi-crosshair"></i>
                                    <span>Target</span>
                                </div>
                            </div>
                        </div>

                        <!-- Moving Puzzle Piece -->
                        <div class="moving-piece" id="movingPiece">
                            <canvas class="piece-canvas" id="pieceCanvas" width="120" height="90"></canvas>
                            <div class="piece-glow"></div>
                        </div>

                        <!-- Distance Indicator -->
                        <div class="distance-line" id="distanceLine"></div>

                    </div>

                    <!-- Control Slider -->
                    <div class="control-slider-area">
                        <div class="slider-header">
                            <span class="slider-title">Kontrol Posisi Puzzle</span>
                            <div class="distance-info">
                                <span class="distance-label">Jarak dari target: </span>
                                <span class="distance-value" id="distanceValue">--</span>
                                <span class="distance-unit">px</span>
                            </div>
                        </div>

                        <div class="control-slider-track">
                            <!-- Target indicator on slider -->
                            <div class="target-marker" id="targetMarker">
                                <div class="marker-line"></div>
                                <div class="marker-label">TARGET</div>
                            </div>

                            <!-- Slider handle -->
                            <div class="slider-control" id="sliderControl">
                                <i class="bi bi-grip-horizontal"></i>
                            </div>

                            <!-- Success zone indicator -->
                            <div class="success-zone" id="successZone"></div>
                        </div>

                        <div class="slider-labels">
                            <span class="label-left">Kiri</span>
                            <span class="label-center">Tengah</span>
                            <span class="label-right">Kanan</span>
                        </div>
                    </div>

                </div>

                <!-- Status Display -->
                <div class="status-display" id="statusDisplay">
                    <div class="status-item checking d-none" id="checkingStatus">
                        <div class="spinner-border spinner-border-sm text-info me-2"></div>
                        <span>Memeriksa posisi...</span>
                    </div>
                    <div class="status-item success d-none" id="successStatus">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <span>Sempurna! Puzzle piece pas dengan target!</span>
                    </div>
                    <div class="status-item warning d-none" id="warningStatus">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                        <span>Hampir! Geser sedikit lagi...</span>
                    </div>
                    <div class="status-item error d-none" id="errorStatus">
                        <i class="bi bi-x-circle-fill text-danger me-2"></i>
                        <span>Masih jauh dari target, coba lagi!</span>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="resetButton">
                    <i class="bi bi-arrow-clockwise me-1"></i>Reset
                </button>
                <button type="button" class="btn btn-outline-info" id="showTargetButton">
                    <i class="bi bi-eye me-1"></i>Tunjukkan Target
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Hidden Token Input -->
<input type="hidden" name="slider_token" id="slider-token" value="">

<style>
    /* Base Modal Styles */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 15px 20px;
        text-align: center;
    }

    .modal-title {
        font-size: 1.1rem;
        font-weight: 600;
        width: 100%;
    }

    .modal-body {
        padding: 20px;
    }

    .instructions {
        background: #e8f5e9;
        padding: 12px 15px;
        border-radius: 8px;
        border-left: 4px solid #28a745;
    }

    .instruction-text {
        line-height: 1.4;
    }

    /* Responsive Puzzle Container */
    .responsive-puzzle-container {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .puzzle-main-area {
        position: relative;
        width: 100%;
        height: 200px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    /* Complete Background */
    .complete-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .complete-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Responsive Hole Overlay */
    .hole-overlay {
        position: absolute;
        top: 50%;
        right: 30px;
        transform: translateY(-50%);
        width: 80px;
        height: 60px;
        z-index: 2;
    }

    .hole-content {
        position: relative;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hole-border {
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border: 2px dashed #ffc107;
        border-radius: 10px;
        animation: targetPulse 2s infinite;
    }

    @keyframes targetPulse {

        0%,
        100% {
            opacity: 0.7;
            border-color: #ffc107;
        }

        50% {
            opacity: 1;
            border-color: #ff8f00;
        }
    }

    .hole-indicator {
        text-align: center;
        color: #ffc107;
        font-size: 10px;
        font-weight: 600;
    }

    .hole-indicator i {
        display: block;
        font-size: 18px;
        margin-bottom: 3px;
    }

    .hole-overlay.perfect .hole-border {
        border-color: #28a745;
        animation: successPulse 1s infinite;
    }

    .hole-overlay.perfect .hole-indicator {
        color: #28a745;
    }

    @keyframes successPulse {

        0%,
        100% {
            border-color: #28a745;
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
        }

        50% {
            border-color: #20c997;
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.8);
        }
    }

    /* Responsive Moving Puzzle Piece */
    .moving-piece {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        width: 80px;
        height: 60px;
        z-index: 3;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .piece-canvas {
        width: 100%;
        height: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.9);
    }

    .piece-glow {
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        border-radius: 10px;
        background: linear-gradient(45deg, transparent, rgba(33, 150, 243, 0.3), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .moving-piece.near-target .piece-glow {
        opacity: 1;
        animation: glowPulse 1.5s infinite;
    }

    @keyframes glowPulse {

        0%,
        100% {
            background: linear-gradient(45deg, transparent, rgba(33, 150, 243, 0.3), transparent);
        }

        50% {
            background: linear-gradient(45deg, transparent, rgba(255, 193, 7, 0.5), transparent);
        }
    }

    .moving-piece.perfect {
        animation: perfectFit 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes perfectFit {
        0% {
            transform: translateY(-50%) scale(1);
        }

        50% {
            transform: translateY(-50%) scale(1.05) rotate(2deg);
        }

        100% {
            transform: translateY(-50%) scale(1) rotate(0deg);
        }
    }

    /* Distance Line */
    .distance-line {
        position: absolute;
        top: 50%;
        left: 0;
        height: 2px;
        background: linear-gradient(90deg, #ff4757, #ffa502, #ff4757);
        transform: translateY(-50%);
        z-index: 1;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .distance-line.visible {
        opacity: 0.7;
    }

    /* Responsive Control Slider */
    .control-slider-area {
        background: white;
        padding: 15px;
        border-radius: 10px;
        border: 2px solid #e9ecef;
    }

    .slider-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .slider-title {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }

    .distance-info {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .distance-value {
        font-weight: 600;
        color: #28a745;
        font-size: 1rem;
    }

    .distance-value.far {
        color: #dc3545;
    }

    .distance-value.close {
        color: #ffc107;
    }

    .distance-value.perfect {
        color: #28a745;
        animation: perfectBlink 1s infinite;
    }

    @keyframes perfectBlink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.6;
        }
    }

    .control-slider-track {
        position: relative;
        height: 50px;
        background: linear-gradient(90deg, #e3f2fd 0%, #f3e5f5 100%);
        border-radius: 25px;
        border: 2px solid #dee2e6;
        margin-bottom: 10px;
        overflow: visible;
    }

    /* Responsive Target Marker */
    .target-marker {
        position: absolute;
        top: -10px;
        transform: translateX(-50%);
        z-index: 2;
    }

    .marker-line {
        width: 3px;
        height: 70px;
        background: #ff9800;
        margin: 0 auto;
        border-radius: 2px;
        box-shadow: 0 0 8px rgba(255, 152, 0, 0.5);
    }

    .marker-label {
        text-align: center;
        font-size: 8px;
        font-weight: 700;
        color: #ff9800;
        margin-top: 3px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    /* Success Zone */
    .success-zone {
        position: absolute;
        top: 50%;
        transform: translateY(-50%) translateX(-50%);
        height: 60px;
        width: 30px;
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.2), rgba(32, 201, 151, 0.2));
        border-radius: 15px;
        border: 2px dashed #28a745;
        z-index: 1;
        opacity: 0.6;
    }

    /* Responsive Slider Control */
    .slider-control {
        position: absolute;
        top: 50%;
        left: 3px;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-radius: 22px;
        cursor: grab;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        transition: all 0.2s ease;
        box-shadow: 0 3px 12px rgba(0, 123, 255, 0.4);
        z-index: 10;
        border: 3px solid white;
    }

    .slider-control:hover {
        transform: translateY(-50%) scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
    }

    .slider-control:active,
    .slider-control.dragging {
        cursor: grabbing;
        transform: translateY(-50%) scale(1.1);
    }

    .slider-control.success {
        background: linear-gradient(135deg, #28a745, #20c997);
        animation: controlSuccess 1s ease-in-out;
    }

    @keyframes controlSuccess {

        0%,
        100% {
            transform: translateY(-50%) scale(1);
        }

        25% {
            transform: translateY(-50%) scale(1.15);
        }

        50% {
            transform: translateY(-50%) scale(1.05);
        }

        75% {
            transform: translateY(-50%) scale(1.1);
        }
    }

    .slider-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #6c757d;
        font-weight: 500;
    }

    /* Responsive Status Display */
    .status-display {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 12px;
        min-height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .status-item {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-item.success .status-text {
        color: #28a745;
    }

    .status-item.warning .status-text {
        color: #ffc107;
    }

    .status-item.error .status-text {
        color: #dc3545;
    }

    /* Alert Responsive */
    .alert {
        padding: 10px 12px;
        font-size: 0.85rem;
        border-radius: 6px;
    }

    /* Modal Footer Responsive */
    .modal-footer {
        padding: 15px 20px;
        justify-content: center;
        gap: 10px;
    }

    .modal-footer .btn {
        font-size: 0.85rem;
        padding: 6px 12px;
    }

    /* ================================= */
    /* RESPONSIVE BREAKPOINTS */
    /* ================================= */

    /* Extra Small Devices (phones, less than 576px) */
    @media (max-width: 575.98px) {
        .modal-fullscreen-sm-down {
            width: 100vw;
            max-width: none;
            height: 100vh;
            margin: 0;
        }

        .modal-fullscreen-sm-down .modal-content {
            height: 100vh;
            border-radius: 0;
        }

        .modal-header {
            border-radius: 0;
            padding: 12px 15px;
        }

        .modal-title {
            font-size: 1rem;
        }

        .modal-body {
            padding: 15px;
            flex: 1;
            overflow-y: auto;
        }

        .puzzle-main-area {
            height: 160px;
        }

        .hole-overlay,
        .moving-piece {
            width: 60px;
            height: 45px;
        }

        .piece-canvas {
            width: 60px;
            height: 45px;
        }

        .hole-indicator i {
            font-size: 14px;
        }

        .control-slider-track {
            height: 40px;
        }

        .slider-control {
            width: 36px;
            height: 36px;
            font-size: 12px;
        }

        .target-marker .marker-line {
            height: 60px;
            width: 2px;
        }

        .success-zone {
            width: 25px;
            height: 50px;
        }

        .responsive-puzzle-container {
            padding: 12px;
        }

        .control-slider-area {
            padding: 12px;
        }

        .slider-header {
            margin-bottom: 12px;
        }

        .status-display {
            padding: 10px;
            min-height: 40px;
        }

        .modal-footer {
            padding: 12px 15px;
        }
    }

    /* Small Devices (landscape phones, 576px and up) */
    @media (min-width: 576px) and (max-width: 767.98px) {
        .modal-lg {
            max-width: 90%;
        }

        .puzzle-main-area {
            height: 180px;
        }

        .hole-overlay,
        .moving-piece {
            width: 70px;
            height: 50px;
        }

        .piece-canvas {
            width: 70px;
            height: 50px;
        }

        .control-slider-track {
            height: 45px;
        }

        .slider-control {
            width: 40px;
            height: 40px;
            font-size: 13px;
        }
    }

    /* Medium Devices (tablets, 768px and up) */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .modal-lg {
            max-width: 600px;
        }

        .puzzle-main-area {
            height: 220px;
        }

        .hole-overlay,
        .moving-piece {
            width: 90px;
            height: 70px;
        }

        .piece-canvas {
            width: 90px;
            height: 70px;
        }

        .control-slider-track {
            height: 55px;
        }

        .slider-control {
            width: 48px;
            height: 48px;
            font-size: 16px;
        }
    }

    /* Large Devices (desktops, 992px and up) */
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .modal-lg {
            max-width: 700px;
        }

        .puzzle-main-area {
            height: 250px;
        }

        .hole-overlay,
        .moving-piece {
            width: 100px;
            height: 75px;
        }

        .piece-canvas {
            width: 100px;
            height: 75px;
        }
    }

    /* Extra Large Devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {
        .modal-lg {
            max-width: 800px;
        }

        .modal-body {
            padding: 30px;
        }

        .puzzle-main-area {
            height: 280px;
        }

        .hole-overlay,
        .moving-piece {
            width: 120px;
            height: 90px;
        }

        .piece-canvas {
            width: 120px;
            height: 90px;
        }

        .responsive-puzzle-container {
            padding: 25px;
        }

        .control-slider-area {
            padding: 20px;
        }
    }

    /* Ultra Wide Screens (1400px and up) */
    @media (min-width: 1400px) {
        .modal-lg {
            max-width: 900px;
        }

        .puzzle-main-area {
            height: 320px;
        }

        .hole-overlay,
        .moving-piece {
            width: 140px;
            height: 105px;
        }

        .piece-canvas {
            width: 140px;
            height: 105px;
        }
    }

    /* Landscape Mobile Specific */
    @media (max-height: 500px) and (orientation: landscape) {
        .modal-fullscreen-sm-down .modal-content {
            height: 100vh;
        }

        .puzzle-main-area {
            height: 140px !important;
        }

        .hole-overlay,
        .moving-piece {
            width: 50px !important;
            height: 35px !important;
        }

        .piece-canvas {
            width: 50px !important;
            height: 35px !important;
        }

        .control-slider-track {
            height: 35px !important;
        }

        .slider-control {
            width: 30px !important;
            height: 30px !important;
            font-size: 10px !important;
        }
    }

    /* High DPI Displays */
    @media (-webkit-min-device-pixel-ratio: 2),
    (min-resolution: 192dpi) {
        .piece-canvas {
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
        }
    }

    /* Touch Device Enhancements */
    @media (pointer: coarse) {
        .slider-control {
            transform: translateY(-50%) scale(1.1);
        }

        .slider-control:active {
            transform: translateY(-50%) scale(1.2);
        }

        .hole-overlay,
        .moving-piece {
            touch-action: none;
        }
    }

    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .modal-content {
            background-color: #212529;
            color: #fff;
        }

        .responsive-puzzle-container {
            background: #343a40;
        }

        .control-slider-area {
            background: #495057;
            border-color: #6c757d;
        }

        .status-display {
            background: #343a40;
        }

        .instructions {
            background: #1e3e2e;
            border-color: #28a745;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalId = '{{ $modalId }}';
        const modal = document.getElementById(modalId);

        if (!modal) return;

        // Configuration
        const CONFIG = {
            pieceWidth: 120,
            pieceHeight: 90,
            containerWidth: 640, // Approximate container width
            tolerance: 15, // 15px tolerance for success
            warningRange: 40, // 40px range for warning
            minTargetDistance: 150, // Minimum distance from left edge
            maxTargetDistance: 450 // Maximum distance from left edge
        };

        // State
        let state = {
            isVerified: false,
            isDragging: false,
            targetX: 0, // Target X position for the piece
            currentX: 30, // Current X position of the piece
            sliderMaxMove: 0,
            distance: 0
        };

        // DOM Elements
        const elements = {
            completeImg: modal.querySelector('#completeImg'),
            holeOverlay: modal.querySelector('#holeOverlay'),
            movingPiece: modal.querySelector('#movingPiece'),
            pieceCanvas: modal.querySelector('#pieceCanvas'),
            distanceLine: modal.querySelector('#distanceLine'),
            sliderControl: modal.querySelector('#sliderControl'),
            targetMarker: modal.querySelector('#targetMarker'),
            successZone: modal.querySelector('#successZone'),
            distanceValue: modal.querySelector('#distanceValue'),
            checkingStatus: modal.querySelector('#checkingStatus'),
            successStatus: modal.querySelector('#successStatus'),
            warningStatus: modal.querySelector('#warningStatus'),
            errorStatus: modal.querySelector('#errorStatus'),
            errorAlert: modal.querySelector('#errorAlert'),
            errorMessage: modal.querySelector('#errorMessage'),
            tokenInput: document.getElementById('slider-token'),
            resetButton: modal.querySelector('#resetButton'),
            showTargetButton: modal.querySelector('#showTargetButton')
        };

        // Initialize when modal is shown
        modal.addEventListener('shown.bs.modal', initializeCorrectLogic);

        function initializeCorrectLogic() {
            hideAllStatus();
            hideAlert();

            // Generate random target position (NOT at the end, but somewhere in middle-right area)
            state.targetX = Math.random() * (CONFIG.maxTargetDistance - CONFIG.minTargetDistance) + CONFIG
                .minTargetDistance;

            // Position the hole overlay at target location
            elements.holeOverlay.style.left = state.targetX + 'px';

            // Calculate slider constraints
            const sliderTrack = modal.querySelector('.control-slider-track');
            state.sliderMaxMove = sliderTrack.offsetWidth - 60; // 60px handle width + padding

            // Position target marker on slider
            const targetPercent = (state.targetX - 30) / (CONFIG.containerWidth - 150); // Adjust for piece size
            const targetSliderPos = targetPercent * state.sliderMaxMove;
            elements.targetMarker.style.left = (targetSliderPos + 30) + 'px';

            // Position success zone
            elements.successZone.style.left = (targetSliderPos + 30) + 'px';

            // Setup precise image cropping
            setupCorrectCropping();

            // Generate token
            generateToken();

            // Reset positions
            resetToStart();
            updateDistance();
        }

        function setupCorrectCropping() {
            const canvas = elements.pieceCanvas;
            const ctx = canvas.getContext('2d');
            const img = new Image();

            img.onload = function() {
                // Calculate crop position based on target location
                const scaleX = img.width / CONFIG.containerWidth;
                const scaleY = img.height / 280; // Container height

                const cropX = state.targetX * scaleX;
                const cropY = (140 - CONFIG.pieceHeight / 2) * scaleY; // Center vertically
                const cropW = CONFIG.pieceWidth * scaleX;
                const cropH = CONFIG.pieceHeight * scaleY;

                // Clear canvas
                ctx.clearRect(0, 0, CONFIG.pieceWidth, CONFIG.pieceHeight);

                // Draw cropped image
                ctx.drawImage(
                    img,
                    cropX, cropY, cropW, cropH,
                    0, 0, CONFIG.pieceWidth, CONFIG.pieceHeight
                );

                // Add border effect
                ctx.strokeStyle = 'rgba(255,255,255,0.9)';
                ctx.lineWidth = 3;
                ctx.strokeRect(1.5, 1.5, CONFIG.pieceWidth - 3, CONFIG.pieceHeight - 3);
            };

            img.src = '{{ $puzzleImage }}';
        }

        function generateToken() {
            const token = 'correct_logic_' +
                Math.random().toString(36).substr(2, 9) + '_' +
                Date.now() + '_' +
                Math.floor(state.targetX);

            if (elements.tokenInput) {
                elements.tokenInput.value = token;
            }
        }

        // Slider Events
        elements.sliderControl.addEventListener('mousedown', startDrag);
        elements.sliderControl.addEventListener('touchstart', startDrag, {
            passive: false
        });
        document.addEventListener('mousemove', drag);
        document.addEventListener('touchmove', drag, {
            passive: false
        });
        document.addEventListener('mouseup', endDrag);
        document.addEventListener('touchend', endDrag);

        function startDrag(e) {
            if (state.isVerified) return;

            e.preventDefault();
            state.isDragging = true;
            state.startX = getEventX(e);

            elements.sliderControl.classList.add('dragging');
            hideAlert();
        }

        function drag(e) {
            if (!state.isDragging || state.isVerified) return;

            e.preventDefault();

            const deltaX = getEventX(e) - state.startX;
            const newSliderPos = Math.max(0, Math.min(deltaX, state.sliderMaxMove));

            // Update slider position
            elements.sliderControl.style.left = (5 + newSliderPos) + 'px';

            // Calculate piece position (NOT proportional to slider end, but to target location)
            const movePercent = newSliderPos / state.sliderMaxMove;
            const maxPieceMove = CONFIG.containerWidth - CONFIG.pieceWidth - 30; // Max piece movement
            state.currentX = 30 + (movePercent * maxPieceMove);

            // Update piece position
            elements.movingPiece.style.left = state.currentX + 'px';

            // Update distance and visual feedback
            updateDistance();
            updateVisualFeedback();

            // Check if piece is at target (real-time checking)
            checkTargetAlignment();
        }

        function endDrag(e) {
            if (!state.isDragging || state.isVerified) return;

            state.isDragging = false;
            elements.sliderControl.classList.remove('dragging');

            // Final verification after drag ends
            setTimeout(() => verifyTargetAlignment(), 200);
        }

        function updateDistance() {
            state.distance = Math.abs(state.currentX - state.targetX);

            // Update distance display
            elements.distanceValue.textContent = Math.round(state.distance);

            // Update distance value styling
            elements.distanceValue.classList.remove('far', 'close', 'perfect');
            if (state.distance <= CONFIG.tolerance) {
                elements.distanceValue.classList.add('perfect');
            } else if (state.distance <= CONFIG.warningRange) {
                elements.distanceValue.classList.add('close');
            } else {
                elements.distanceValue.classList.add('far');
            }
        }

        function updateVisualFeedback() {
            // Update distance line
            const lineStart = Math.min(state.currentX + CONFIG.pieceWidth / 2, state.targetX + CONFIG
                .pieceWidth / 2);
            const lineEnd = Math.max(state.currentX + CONFIG.pieceWidth / 2, state.targetX + CONFIG.pieceWidth /
                2);
            const lineWidth = Math.abs(lineEnd - lineStart);

            elements.distanceLine.style.left = lineStart + 'px';
            elements.distanceLine.style.width = lineWidth + 'px';
            elements.distanceLine.classList.toggle('visible', state.distance > CONFIG.tolerance);

            // Update piece visual state
            elements.movingPiece.classList.remove('near-target', 'perfect');
            if (state.distance <= CONFIG.tolerance) {
                elements.movingPiece.classList.add('perfect');
            } else if (state.distance <= CONFIG.warningRange) {
                elements.movingPiece.classList.add('near-target');
            }
        }

        function checkTargetAlignment() {
            hideAllStatus();

            if (state.distance <= CONFIG.tolerance) {
                showStatus('success');
            } else if (state.distance <= CONFIG.warningRange) {
                showStatus('warning');
            } else {
                showStatus('error');
            }
        }

        function verifyTargetAlignment() {
            showStatus('checking');

            setTimeout(() => {
                if (state.distance <= CONFIG.tolerance) {
                    achieveSuccess();
                } else {
                    showFailure();
                }
            }, 800);
        }

        function achieveSuccess() {
            state.isVerified = true;
            hideAllStatus();
            showStatus('success');

            // Snap to exact target position
            state.currentX = state.targetX;
            elements.movingPiece.style.left = state.targetX + 'px';
            elements.movingPiece.classList.add('perfect');
            elements.sliderControl.classList.add('success');
            elements.holeOverlay.classList.add('perfect');

            // Update final metrics
            updateDistance();
            updateVisualFeedback();

            // Hide distance line on success
            elements.distanceLine.classList.remove('visible');

            // Auto close and update form
            setTimeout(() => {
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) bsModal.hide();
                updateFormStatus('success');
            }, 2500);
        }

        function showFailure() {
            hideAllStatus();

            if (state.distance <= CONFIG.warningRange) {
                showStatus('warning');
                showAlert(
                    `Hampir benar! Jarak hanya ${Math.round(state.distance)}px dari target. Coba geser sedikit lagi.`
                );
            } else {
                showStatus('error');
                showAlert(
                    `Masih jauh dari target. Jarak ${Math.round(state.distance)}px. Target di posisi ${Math.round((state.targetX/CONFIG.containerWidth)*100)}%.`
                );
            }

            // Auto reset after delay
            setTimeout(() => {
                resetToStart();
                hideAllStatus();
                hideAlert();
            }, 3000);
        }

        function resetToStart() {
            state.currentX = 30;
            elements.sliderControl.style.left = '5px';
            elements.movingPiece.style.left = '30px';
            elements.movingPiece.classList.remove('near-target', 'perfect');
            elements.holeOverlay.classList.remove('perfect');
            updateDistance();
            updateVisualFeedback();
        }

        function showStatus(type) {
            hideAllStatus();
            const statusElement = elements[type + 'Status'];
            if (statusElement) {
                statusElement.classList.remove('d-none');
            }
        }

        function hideAllStatus() {
            ['checking', 'success', 'warning', 'error'].forEach(type => {
                const element = elements[type + 'Status'];
                if (element) element.classList.add('d-none');
            });
        }

        function showAlert(message) {
            if (elements.errorMessage) elements.errorMessage.textContent = message;
            if (elements.errorAlert) elements.errorAlert.classList.remove('d-none');
        }

        function hideAlert() {
            if (elements.errorAlert) elements.errorAlert.classList.add('d-none');
        }

        function updateFormStatus(status) {
            const statusElement = document.getElementById('verification-status');
            const submitBtn = document.getElementById('submit-btn');
            const verifyBtn = document.getElementById('verify-btn');

            if (status === 'success' && statusElement) {
                statusElement.className = 'verification-status-inline verification-success';
                statusElement.innerHTML =
                    '<i class="bi bi-shield-check me-2"></i>Puzzle berhasil diletakkan pada posisi yang tepat!';

                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.cursor = 'pointer';
                }

                if (verifyBtn) {
                    verifyBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Terverifikasi';
                    verifyBtn.disabled = true;
                    verifyBtn.style.background = '#28a745';
                }
            }
        }

        function getEventX(e) {
            return e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
        }

        // Button Events
        elements.resetButton?.addEventListener('click', function() {
            state.isVerified = false;
            elements.movingPiece.classList.remove('perfect');
            elements.sliderControl.classList.remove('success');
            elements.holeOverlay.classList.remove('perfect');
            resetToStart();
            hideAllStatus();
            hideAlert();

            const bsModal = bootstrap.Modal.getInstance(modal);
            if (bsModal) bsModal.hide();
        });

        elements.showTargetButton?.addEventListener('click', function() {
            // Temporarily highlight target area
            elements.holeOverlay.style.background = 'rgba(255, 193, 7, 0.8)';
            elements.targetMarker.style.transform = 'translateX(-50%) scale(1.3)';
            elements.successZone.style.opacity = '1';

            const targetPercent = Math.round((state.targetX / CONFIG.containerWidth) * 100);
            showAlert(
                `Target berada di posisi ${targetPercent}% dari kiri. Letakkan puzzle piece tepat di area yang berkedip.`
            );

            setTimeout(() => {
                elements.holeOverlay.style.background = '';
                elements.targetMarker.style.transform = 'translateX(-50%) scale(1)';
                elements.successZone.style.opacity = '0.6';
                hideAlert();
            }, 3000);
        });

        // Reset on modal close
        modal.addEventListener('hidden.bs.modal', function() {
            if (!state.isVerified && elements.tokenInput) {
                elements.tokenInput.value = '';
            }

            if (!state.isVerified) {
                resetToStart();
                hideAllStatus();
                hideAlert();
            }
        });
    });

    // Global function to show modal
    function showSliderVerification() {
        const modal = new bootstrap.Modal(document.getElementById('{{ $modalId }}'));
        modal.show();
    }
</script>
